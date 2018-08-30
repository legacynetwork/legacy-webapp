from django.contrib.auth.models import AbstractUser
from django.db import models


class User(AbstractUser):
    is_active = models.BooleanField(_('active'), default=True)
    is_registered = models.BooleanField()

    first_name = models.CharField(_('first name'), max_length=30, blank=True)
    last_name = models.CharField(_('last name'), max_length=30, blank=True)
    birth_date = models.DateTimeField()
    death_date = models.DateTimeField()


    avatar = models.ImageField(upload_to='avatars/', null=True, blank=True)

    def __str__(self):
        return self.email
