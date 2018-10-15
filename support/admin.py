from django.contrib import admin

from .models import Message, EmailSuscriber


class EmailMessageAdmin(admin.ModelAdmin):
    list_display = ['created', 'from_email', 'name', 'message', ]


class EmailSuscriberAdmin(admin.ModelAdmin):
    list_display = ['__str__', 'created', 'unique']
    list_filter = ['unique', ]


admin.site.register(Message, EmailMessageAdmin)
admin.site.register(EmailSuscriber, EmailSuscriberAdmin)
