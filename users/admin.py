from django.contrib import admin
from django.contrib.auth.admin import UserAdmin

from .forms import UserCreationForm, UserChangeForm
from .models import User


class UserAdmin(UserAdmin):
    list_display = ['created', 'email', 'first_name', 'last_name', ]
    add_form = UserCreationForm
    form = UserChangeForm
    model = User
    inclde = ('date_joined', 'email', 'first_name', 'is_active', 'is_staff', 'is_superuser', 'last_login', 'last_name', 'password', 'user_permissions', 'username')


admin.site.register(User, UserAdmin)
