from django.contrib.auth import get_user_model
from django.contrib.postgres.fields import ArrayField, JSONField
from django.core.mail import send_mail
from django.db import models
from django_extensions.db.models import TimeStampedModel

User = get_user_model()


class Message(TimeStampedModel):
    name = models.CharField(max_length=100)
    from_email = models.EmailField()
    message = models.TextField(max_length=1000, blank=True, null=True)

    def save(self, *arg, **kwargs):
        self.send_email_during_save()
        self.super().save()

    def send_email_during_save(self):
        subject = f"Message received from {self.email}"
        message = self.message
        sender = settings.DEFAULT_FROM_EMAIL
        # sender = self.from_email
        recipients = [settings.ADMINS[1], ]
        send_mail(subject, message, sender, recipients)

    def __str__(self):
        return "{} - {}".format(self.from_email, self.created)


class EmailSuscriber(TimeStampedModel):
    email = models.EmailField()
    unique = models.BooleanField(default=False)
    preferences = JSONField(default=dict)
    tags = ArrayField(models.CharField(max_length=200), blank=True, default=list)
    user = models.ForeignKey(
        User,
        on_delete=models.CASCADE,
        related_name='email_subscriptions',
        null=True
        )

    def save(self, *args, **kwargs):
        if not self.unique and self.is_unique(self.email):
            self.unique = True
        self.user = self.get_user()
        super(EmailSuscriber, self).save(*args, **kwargs)

    def get_user(self):
        try:
            user = User.objects.get(self.email)
            return user
        except DoesNotExist:
            return None

    def is_unique(self, email):
        return not EmailSuscriber.objects.filter(email=email).exists()

    def __str__(self):
        return "{}".format(self.email)
