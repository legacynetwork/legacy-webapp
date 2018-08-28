from django.db import models
from django_extensions.db.models import TimeStampedModel



class Contact(TimeStampedModel):
    name = models.CharField(max_length=100)
    email = models.EmailField()
    message = models.TextField(max_length=1000, blank=True, null=True)
    date_created = models.DateField(verbose_name="Created on date", auto_now_add="True")
