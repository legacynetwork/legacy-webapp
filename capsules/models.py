import os.path

from django.db import models
from users.models import User
from django_extensions.db.models import TimeStampedModel


COMPRESSION_TOOL = 'tar'
ENCRYPTION_TOOL = 'opensssl'


class Capsule(TimeStampedModel):
    """
    Capsule model
    """
    # state choice for capsule
    CAPSULE_STATE_CHOICES = [
        ('o', 'offchain'),
        ('e', 'empty'),
        ('t', 'transaction-in-process'),
        ('i', 'intiated')
    ]
    user = models.ForeignKey()
    name = models.CharField(max_length=30)
    active = models.BooleanField(default=False)
    state = models.CharField(max_length=1, choices=CAPSULE_STATE_CHOICES, default='o')
    description = models.CharField(max_length=200)
    image = models.ImageField(upload_to='capsule_covers/', null=True, blank=True)

    assignees = models.ManyToManyField(User)


class Memory(TimeStampedModel):
    # state choice for capsule
    MEMORY_STATE_CHOICES = [
        ('u', 'uploading'),
        ('d', 'done'),
        ('e', 'error'),
    ]
    capsule = models.ForeignKey(Capsule, )
    file = models.ImageField(upload_to='capsule_covers/', null=True, blank=True)
    state = models.CharField(max_length=1, choices=MEMORY_STATE_CHOICES, default='u')

    def get_file_type(self):
        extension = os.path.splitext(self.file)[1][1:]
        return extension

    def detach_memory_from_capsule():
        pass

    def upload_to_file_storage():
        pass

    def compress_file():
        pass

    def encrypt_file():
        pass

    def get_hash_of_file():
        pass
