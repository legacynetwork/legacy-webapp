# Generated by Django 2.0.8 on 2018-09-01 09:44

from django.conf import settings
from django.db import migrations, models
import django.db.models.deletion
import django_extensions.db.fields


class Migration(migrations.Migration):

    initial = True

    dependencies = [
        migrations.swappable_dependency(settings.AUTH_USER_MODEL),
    ]

    operations = [
        migrations.CreateModel(
            name='Capsule',
            fields=[
                ('id', models.AutoField(auto_created=True, primary_key=True, serialize=False, verbose_name='ID')),
                ('created', django_extensions.db.fields.CreationDateTimeField(auto_now_add=True, verbose_name='created')),
                ('modified', django_extensions.db.fields.ModificationDateTimeField(auto_now=True, verbose_name='modified')),
                ('name', models.CharField(max_length=30)),
                ('active', models.BooleanField(default=False)),
                ('state', models.CharField(choices=[('o', 'offchain'), ('e', 'empty'), ('t', 'transaction-in-process'), ('i', 'intiated')], default='o', max_length=1)),
                ('description', models.CharField(max_length=200)),
                ('image', models.ImageField(blank=True, null=True, upload_to='capsule_covers/')),
                ('assignees', models.ManyToManyField(related_name='assignees', to=settings.AUTH_USER_MODEL)),
                ('user', models.ForeignKey(on_delete=django.db.models.deletion.CASCADE, to=settings.AUTH_USER_MODEL)),
            ],
            options={
                'ordering': ('-modified', '-created'),
                'get_latest_by': 'modified',
                'abstract': False,
            },
        ),
        migrations.CreateModel(
            name='Memory',
            fields=[
                ('id', models.AutoField(auto_created=True, primary_key=True, serialize=False, verbose_name='ID')),
                ('created', django_extensions.db.fields.CreationDateTimeField(auto_now_add=True, verbose_name='created')),
                ('modified', django_extensions.db.fields.ModificationDateTimeField(auto_now=True, verbose_name='modified')),
                ('file', models.ImageField(blank=True, null=True, upload_to='capsule_covers/')),
                ('state', models.CharField(choices=[('u', 'uploading'), ('d', 'done'), ('e', 'error')], default='u', max_length=1)),
                ('capsule', models.ForeignKey(on_delete=django.db.models.deletion.CASCADE, to='capsules.Capsule')),
            ],
            options={
                'verbose_name_plural': 'memories',
            },
        ),
    ]
