from django.urls import reverse_lazy
from django.utils.decorators import method_decorator
from django.views import generic

from .models import Capsule

# decorating the class views in urls:
# https://docs.djangoproject.com/en/dev/topics/class-based-views/intro/#decorating-class-based-views
from allauth.account.decorators import verified_email_required


@method_decorator(verified_email_required, name='dispatch')
class CapsuleListView(generic.ListView):
    model = Capsule


@method_decorator(verified_email_required, name='dispatch')
class CapsuleCreateView(generic.CreateView):
    model = Capsule
    fields = ['name', "active", "state", "description", "image", ]
    success_url = reverse_lazy('capsules:capsule_list')

    def form_valid(self, form):
        form.instance.user = self.request.user
        return super().form_valid(form)


@method_decorator(verified_email_required, name='dispatch')
class CapsuleDetailView(generic.DetailView):
    model = Capsule
    pk_url_kwarg = 'capsule_id'


@method_decorator(verified_email_required, name='dispatch')
class CapsuleUpdateView(generic.UpdateView):
    model = Capsule
    pk_url_kwarg = 'capsule_id'
    fields = [
        'name',
        'description',
        'image',
        'assignees',
    ]


@method_decorator(verified_email_required, name='dispatch')
class CapsuleDeleteView(generic.DeleteView):
    model = Capsule
    pk_url_kwarg = 'capsule_id'
