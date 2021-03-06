from django.conf import settings
from django.contrib import admin
from django.urls import path, include

from support.views import HomeView


urlpatterns = [
    path('', HomeView.as_view(), name="home"),
    path('admin/', admin.site.urls),
    path('support/', include('support.urls')),
    path('capsules/', include('capsules.urls')),

    # user and auth
    path('users/', include('users.urls')),
    path('accounts/', include('allauth.urls')),
]

if settings.DEBUG:
    import debug_toolbar
    urlpatterns = [
        path('__debug__/', include(debug_toolbar.urls)),
    ] + urlpatterns
