from django.db import models
from users.models import User


class Capsule(models.Model):
    """
    Capsule model
    """
    # state choice for capsule
    STATE_CHOICES = [
        ('o', 'offchain'),
        ('e', 'empty'),
        ('t', 'transaction-in-process'),
        ('i', 'intiated')
    ]
    user = models.ForeignKey()
    name = models.CharField(max_length=30)
    active = models.BooleanField(default=False)
    state = models.CharField(max_length=1, choices=STATE_CHOICES, default='o')
    description = models.CharField(max_length=200)
    image = models.ImageField(upload_to='capsule_covers/', null=True, blank=True)

    assignees = models.ManyToManyField(User)
