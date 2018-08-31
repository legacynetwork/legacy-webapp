from django.contrib import admin

from .models import Capsule, Memory


class CapsuleAdmin(admin.ModelAdmin):
    list_display = ['created', ]


class MemoryAdmin(admin.ModelAdmin):
    list_display = ['created', ]


admin.site.register(Capsule, CapsuleAdmin)
admin.site.register(Memory, MemoryAdmin)
