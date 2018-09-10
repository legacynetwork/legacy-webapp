from django.contrib.auth.models import AbstractUser, UserManager
from django.utils.translation import ugettext_lazy as _
from django.db import models

from phonenumber_field.modelfields import PhoneNumberField
from django_eth.models import EthereumAddressField


class UserManager(UserManager):
    pass


class User(AbstractUser):

    SEX = (
        ('n', _('not defined')),
        ('f', _('female')),
        ('m', _('male')),
        ('o', _('other')),
    )

    # this boolean defines if the user has a registered legacy account
    is_registered = models.BooleanField(_('registered'), default=False)
    updated = models.DateTimeField(auto_now=True)

    sex = models.CharField(_('sex'), max_length=1, choices=SEX, default='n', blank=True, null=True)

    birth_date = models.DateTimeField(_('birth date'), blank=True, null=True)
    death_date = models.DateTimeField(_('death date'), blank=True, null=True)

    # TODO: does extending this to a more specific model make sense?
    # more info here: https://github.com/furious-luke/django-address
    # postal_address max_length only for form purposes
    postal_address = models.TextField(_('postal address'), max_length=500, blank=True, null=True)
    phone_number = PhoneNumberField(_('phone number'), blank=True, null=True)
    secondary_phone_number = PhoneNumberField(_('seconday phone'), blank=True, null=True)

    # other identifying info:
    ssn = models.CharField(max_length=50, blank=True, null=True)

    avatar = models.ImageField(_('avatar'), upload_to='avatars/', null=True, blank=True)

    eth_address = EthereumAddressField()

    objects = UserManager()

    def __str__(self):
        return "{}-{}".format(self.email, self.first_name)


class UserAction(TimeStampedModel):
    """Records Actions users make."""

    # TODO: add all use case and finish types
    ACTION_TYPES = [
        ('login', 'Login'),
        ('logout', 'Logout'),
        ('added_capsule', 'Added Capsule'),
        ('updated_capsule', 'Updated Capsule'),
        ('deleted_capsule', 'Deleted Capsule'),
        ('added_memory', 'Added Memory'),
        ('updated_memory', 'Updated Memory'),
        ('deleted_memory', 'Deleted Memory'),
        ('confirmed_transaction', 'Confirmed Transaction'),
        ('pushed_transaction', 'Pushed Transaction'),
        ('updated_avatar', 'Updated Avatar'),
    ]
    action = models.CharField(max_length=50, choices=ACTION_TYPES)
    user = models.ForeignKey(User, on_delete=models.CASCADE)
    ip_address = models.GenericIPAddressField(null=True)
    location_data = JSONField(default=dict)
    metadata = JSONField(default=dict)

    def __str__(self):
        return f"{self.action} | {self.user} | {self.created}"


class Emails(models.Model):
    user = models.ForeignKey(User, on_delete=models.CASCADE)
    secondary_email = models.EmailField()
