# my_project/urls.py
from django.contrib import admin
from django.urls import path, include
from django.views.generic import TemplateView

from support.views import HomeView


urlpatterns = [
    path('', HomeView.as_view(), name="home"),
    path('support/', include('support.urls')),
    path('admin/', admin.site.urls),
    path('accounts/', include('django.contrib.auth.urls')),
]


from django.conf import settings
from django.conf.urls import include, url

if settings.DEBUG:
    import debug_toolbar
    urlpatterns = [
        url(r'^__debug__/', include(debug_toolbar.urls)),
    ] + urlpatterns
