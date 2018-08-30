from django.urls import path

from . import views


app_name = 'support'

urlpatterns = [
    path('thanks_message/', views.MessageView.as_view(), name='thanks_message'),
    path('thanks_email/', views.EmailView.as_view(), name='thanks_email'),
]
