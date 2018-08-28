from django.db import models
from django_extensions.db.models import TimeStampedModel



class Message(TimeStampedModel):
    name = models.CharField(max_length=100)
    from_email = models.EmailField()
    message = models.TextField(max_length=1000, blank=True, null=True)

    def __str__(self):
        return "{} - {}".format(self.from_email, self.created)


class EmailSuscriber(TimeStampedModel):
    email = models.EmailField()
    unique = models.BooleanField(default=False)

    def save(self, *args, **kwargs):
        if self.is_unique(self.email):
            self.unique = True
        super(EmailSuscriber, self).save(*args, **kwargs)

    def is_unique(self, email):
        return not EmailSuscriber.objects.filter(email=email).exists()

    def __str__(self):
        return "{}".format(self.email)
