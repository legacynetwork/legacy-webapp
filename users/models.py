from django.db import models
from django.utils.translation import ugettext_lazy as _
from django.contrib.auth.models import User
from django.db.models.signals import post_save
from django.dispatch import receiver

from django_extensions.db.models import TimeStampedModel
from phonenumber_field.modelfields import PhoneNumberField


class Profile(TimeStampedModel):
    user = models.OneToOneField(User, on_delete=models.CASCADE)

    created = models.DateTimeField(auto_now_add=True)
    updated = models.DateTimeField(auto_now=True)

    name = models.CharField(_('first name'), max_length=255, blank=True)
    birth_date = models.DateTimeField(_('first name'), blank=True, null=True)
    death_date = models.DateTimeField(_('last name'), blank=True, null=True)

    # TODO: does extending this to a more specific model make sense?
    # more info here: https://github.com/furious-luke/django-address
    # postal_address max_length only for form purposes
    postal_address = models.TextField(max_length=500, blank=True, null=True)
    phone_number = PhoneNumberField(blank=True, null=True)
    secondary_phone_number = PhoneNumberField(blank=True, null=True)

    # other identifying info:
    ssn = models.CharField(max_length=50, blank=True, null=True)

    avatar = models.ImageField(upload_to='avatars/', null=True, blank=True)


@receiver(post_save, sender=User)
def create_user_profile(sender, instance, created, **kwargs):
    if created:
        Profile.objects.create(user=instance)


@receiver(post_save, sender=User)
def save_user_profile(sender, instance, **kwargs):
    instance.profile.save()
