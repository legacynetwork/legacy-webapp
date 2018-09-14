from django.contrib import admin

from .models import EmailMessage, EmailSuscriber


class EmailMessageAdmin(admin.ModelAdmin):
    list_display = ['created', 'from_email', 'name', 'message', ]


class EmailSuscriberAdmin(admin.ModelAdmin):
    list_display = ['__str__', 'created', 'unique']


admin.site.register(EmailMessage, EmailMessageAdmin)
admin.site.register(EmailSuscriber, EmailSuscriberAdmin)
