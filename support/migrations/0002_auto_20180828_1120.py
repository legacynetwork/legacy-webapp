# Generated by Django 2.0.8 on 2018-08-28 11:20

from django.db import migrations


class Migration(migrations.Migration):

    dependencies = [
        ('support', '0001_initial'),
    ]

    operations = [
        migrations.RenameField(
            model_name='message',
            old_name='email',
            new_name='from_email',
        ),
    ]