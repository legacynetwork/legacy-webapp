# from django import forms
from django.contrib.auth.forms import UserCreationForm, UserChangeForm
from .models import User as CustomUser


class UserCreationForm(UserCreationForm):

    class Meta(UserCreationForm.Meta):
        model = CustomUser
        fields = ('username', 'email',)


class UserChangeForm(UserChangeForm):

    class Meta:
        model = CustomUser
        fields = UserChangeForm.Meta.fields
