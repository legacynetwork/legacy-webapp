# -*- coding: utf-8 -*-
from django.core.management.base import BaseCommand
from legacy.models import User


class Command(BaseCommand):

    def add_arguments(self, parser):
        parser.add_argument('-m', '--email', nargs='?', default='bob@legacydapp.com')
        parser.add_argument('-p', '--first_name', nargs='?', default='bob')
        parser.add_argument('-n', '--last_name', nargs='?', default='foobar')
        parser.add_argument('-pw', '--password', nargs='?', default='defaultpassword')
        parser.add_argument('-s', '--is_superuser', action='store_true')

    def handle(self, *args, **options):
        admin = User(
                email=options['email'],
                first_name=options['first_name'],
                last_name=options['last_name'],
                is_superuser=options['is_superuser'],
                )
        admin.set_password(options['password'])
        admin.save()
