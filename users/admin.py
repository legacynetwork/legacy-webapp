from django.contrib import admin
from .models import User


class UserAdmin(admin.ModelAdmin):
    list_display = ['created', 'email', 'first_name', 'last_name', ]


admin.site.register(User, UserAdmin)
