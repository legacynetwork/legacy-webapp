from django.contrib.auth.models import AbstractUser
from django.db import models
from django.utils.translation import ugettext_lazy as _

from django_extensions.db.models import TimeStampedModel
from phonenumber_field.modelfields import PhoneNumberField


class User(AbstractUser, TimeStampedModel):
    is_registered = models.BooleanField(_('registered'), default=False)

    first_name = models.CharField(_('first name'), max_length=30, blank=True)
    last_name = models.CharField(_('last name'), max_length=30, blank=True)
    birth_date = models.DateTimeField(blank=True, null=True)
    death_date = models.DateTimeField(blank=True, null=True)

    phone_number = PhoneNumberField(blank=True, null=True)
    phone_number_secondary = PhoneNumberField(blank=True, null=True)
    avatar = models.ImageField(upload_to='avatars/', null=True, blank=True)

    def __str__(self):
        return self.email
