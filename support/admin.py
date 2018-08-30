from django.contrib import admin

from .models import Message, EmailSuscriber


class MessageAdmin(admin.ModelAdmin):
    list_display = ['created', 'from_email', 'name', 'message', ]


class EmailSuscriberAdmin(admin.ModelAdmin):
    list_display = ['__str__', 'created', 'unique']


admin.site.register(Message, MessageAdmin)
admin.site.register(EmailSuscriber, EmailSuscriberAdmin)
