from django.urls import path

# decorating the class views in urls:
# https://docs.djangoproject.com/en/dev/topics/class-based-views/intro/#decorating-class-based-views
# from allauth.account.decorators import verified_email_required

from . import views


app_name = 'capsules'

urlpatterns = [
    path('', views.CapsuleListView.as_view(), name='capsule_list'),
    path('new/', views.CapsuleCreateView.as_view(), name='capsule_create'),
    path('<int:capsule_id>', views.CapsuleDetailView.as_view(), name='capsule_detail'),
    path('<int:capsule_id>/edit', views.CapsuleUpdateView.as_view(), name='capsule_edit'),
    path('<int:capsule_id>/delete', views.CapsuleDeleteView.as_view(), name='capsule_delete'),
]
