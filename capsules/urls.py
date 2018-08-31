from django.urls import path

from . import views


app_name = 'capsules'

urlpatterns = [
    path('', views.CapsuleListView.as_view(), name='capsule_list'),
    path('new/', views.CapsuleCreateView.as_view(), name='capsule_create'),
    path('<capsule_id>', views.CapsuleDetailView.as_view(), name='capsule_detail'),
    path('<capsule_id>/edit', views.CapsuleUpdateView.as_view(), name='capsule_edit'),
    path('<capsule_id>/delete', views.CapsuleDeleteView.as_view(), name='capsule_delete'),
]
