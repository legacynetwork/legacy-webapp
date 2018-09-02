from django.contrib import admin
# from django.contrib.auth import get_user_model
from django.contrib.auth.admin import UserAdmin

from .forms import UserCreationForm, UserChangeForm
from .models import User as CustomUser


class UserAdmin(UserAdmin):
    model = CustomUser
    add_form = UserCreationForm
    form = UserChangeForm
    readonly_fields = ('updated', 'last_login', 'date_joined')

    fieldsets = UserAdmin.fieldsets + (
        (None, {
            'fields': (
                # read-only ^
                'updated',
            )}),
        ('Legacy Fields', {
            'fields': (
                'is_registered',
                'birth_date',
                'death_date',
                'postal_address',
                'phone_number',
                'secondary_phone_number',
                'avatar',
        )})
    )


admin.site.register(CustomUser, UserAdmin)
