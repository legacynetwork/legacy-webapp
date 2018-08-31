from django.urls import reverse_lazy
from django.views import generic

from .models import Capsule


class CapsuleListView(generic.ListView):
    model = Capsule


class CapsuleCreateView(generic.CreateView):
    model = Capsule
    fields = ['name', "active", "state", "description", "image", ]
    success_url = reverse_lazy('capsules:capsule_list')

    def form_valid(self, form):
        form.instance.user = self.request.user
        return super().form_valid(form)


class CapsuleDetailView(generic.DetailView):
    model = Capsule
    pk_url_kwarg = 'capsule_id'


class CapsuleUpdateView(generic.UpdateView):
    model = Capsule
    pk_url_kwarg = 'capsule_id'
    fields = [
        'name',
        'description',
        'image',
        'assignees',
    ]


class CapsuleDeleteView(generic.DeleteView):
    model = Capsule
    pk_url_kwarg = 'capsule_id'
