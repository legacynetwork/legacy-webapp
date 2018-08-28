from django.contrib import admin
from django.urls import path

from . import views


urlpatterns = [
    path('thanks_message/', views.MessageView.as_view(), name='message'),
    path('thanks_email/', views.EmailView.as_view(), name='email'),
]
