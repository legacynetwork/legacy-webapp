import os.path

from django.contrib.auth import get_user_model
from django.db import models
from django_extensions.db.models import TimeStampedModel
from django.urls import reverse

User = get_user_model()


COMPRESSION_TOOL = 'tar'
ENCRYPTION_TOOL = 'opensssl'


class Capsule(TimeStampedModel):
    """
    Capsule model
    """
    CAPSULE_STATE_CHOICES = [
        ('o', 'offchain'),
        ('e', 'empty'),
        ('t', 'transaction-in-process'),
        ('i', 'intiated')
    ]
    user = models.ForeignKey(User, on_delete=models.CASCADE)
    name = models.CharField(max_length=30)
    active = models.BooleanField(default=False)
    state = models.CharField(max_length=1, choices=CAPSULE_STATE_CHOICES, default='o')
    description = models.CharField(max_length=200)
    image = models.ImageField(upload_to='capsule_covers/', null=True, blank=True)

    assignees = models.ManyToManyField(User, related_name="assignees")

    def __str__(self):
        return f"{self.user.id}|{self.name}-active:{self.active}"

    def get_absolute_url(self):
        return reverse('capsules:capsule_detail', kwargs={'capsule_id': self.pk})


class Memory(TimeStampedModel):
    MEMORY_STATE_CHOICES = [
        ('u', 'uploading'),
        ('d', 'done'),
        ('e', 'error'),
    ]
    capsule = models.ForeignKey(Capsule, on_delete=models.CASCADE)
    file = models.FileField(upload_to='memory_storage/', null=True, blank=True)
    state = models.CharField(max_length=1, choices=MEMORY_STATE_CHOICES, default='u')

    class Meta:
        verbose_name_plural = "memories"

    def get_absolute_url(self):
        return reverse('memories:memory_detail', kwargs={memory_id: self.pk})

    def __str__(self):
        return f"{self.capsule.user.id} | {self.file}"

    def get_file_type(self):
        # FieldFile instance?
        # https://docs.djangoproject.com/en/2.1/ref/models/fields/#filefield-and-fieldfile
        extension = os.path.splitext(self.file.name)[1][1:]
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
