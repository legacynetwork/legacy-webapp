import os

from django.test import TestCase, Client
<<<<<<< Updated upstream
from django.urls import reverse
=======
>>>>>>> Stashed changes
from django.core.files import File
from django.conf import settings

from django_webtest import WebTest

from .models import Capsule, Memory

from django.contrib.auth import get_user_model
User = get_user_model()


class TestHomeView(TestCase):

    def setUp(self):
        user = User.objects.create(username='testuser')
        user.set_password('12345678')
        user.save()

        c = Client()
        self.logged_in_user = c.login(username='testuser', password='12345678')

    def test_homepage(self):
        response = self.client.get('/')
        self.assertEqual(response.status_code, 200)

    def test_login(self):
        self.assertTrue(self.logged_in_user)


class CapsuleViewTest(TestCase):

    def setUp(self):
        # user = User.objects.create_user()
        self.user = User.objects.create(email="testuser@email.com", username="testuser")
        self.user.set_password('12345678')
        self.logged_in_user = Client.login(username='testuser', password='12345678')


        self.friend1 = User.objects.create(email="friend1@email.com", username="friend1",)
        self.friend2 = User.objects.create(email="friend2@email.com", username="friend2",)

        self.capsule = Capsule.objects.create(
            user=self.user,
            name="First Capsule",
            active=True,
            state='i',
            description="description text",
        )

        # capsule assignees
        self.capsule.save()
        # adding several assignees to the capsule
        self.capsule.assignees.add(self.friend1)
        self.capsule.assignees.add(self.friend2)


class CapsuleModelTest(TestCase):

    def setUp(self):
        # user = User.objects.create_user()
        self.user = User.objects.create(email="testuser@email.com", username="testuser")
        self.friend1 = User.objects.create(email="friend1@email.com", username="friend1",)
        self.friend2 = User.objects.create(email="friend2@email.com", username="friend2",)

        self.capsule = Capsule.objects.create(
            user=self.user,
            name="First Capsule",
            active=True,
            state='i',
            description="description text",
        )

        # capsule assignees
        self.capsule.save()
        # adding several assignees to the capsule
        self.capsule.assignees.add(self.friend1)
        self.capsule.assignees.add(self.friend2)

        # file_location = os.path.join(settings.BASE_DIR, 'requirements.txt')
        file_loc = os.path.join(settings.BASE_DIR, 'static', 'home', 'images', 'logo-long-blue.png')
        memory_file = File(open(file_loc, 'rb'))

        self.memory = Memory.objects.create(
            capsule=self.capsule,
            state='d',
        )
        self.memory.file.save('logo-long-blue.png', memory_file)

    def test_capsule_str_output(self):
        """test capsule __str__ method"""
        capsule_str = str(self.capsule)
        # {self.user.id}|{self.name}-active:{self.active}"
        self.assertEqual(capsule_str, "1|First Capsule-active:True")

<<<<<<< Updated upstream
    def test_memory_plural_verbose(self):
        self.assertEqual(str(Memory._meta.verbose_name_plural), "memories")

=======
>>>>>>> Stashed changes
    def test_get_file_type(self):
        self.assertEqual(self.memory.get_file_type(), "png")

    def test_get_absolute_url(self):
        self.assertIsNotNone(self.capsule.get_absolute_url())
<<<<<<< Updated upstream
=======


class MemoryModelTest(TestCase):

    def test_memory_plural_verbose(self):
        self.assertEqual(str(Memory._meta.verbose_name_plural), "memories")
>>>>>>> Stashed changes
