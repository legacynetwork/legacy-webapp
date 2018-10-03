from django.contrib import messages
from django.contrib.messages.views import SuccessMessageMixin
from django.views.generic import TemplateView, FormView


from .forms import MessageForm, EmailForm
from .models import Message, EmailSuscriber


class HomeView(TemplateView):

    template_name = 'home.html'


class EmailView(SuccessMessageMixin, FormView):
    template_name = 'home.html'
    form_class = EmailForm
    success_url = '/#subscribe'
    success_message = "Thanks, we'll keep you up to date"


    def form_valid(self, form):
        # This method is called when valid form data has been POSTed.
        # It should return an HttpResponse.
        new_email = EmailSuscriber(
            email = form.cleaned_data['email']
        )
        new_email.save()
        return super().form_valid(form)


class MessageView(SuccessMessageMixin, FormView):
    template_name = 'home.html'
    form_class = MessageForm
    success_url = '/#contact'
    success_message = "Thanks, we'll answer as soon as possible"

    def form_valid(self, form):
        # This method is called when valid form data has been POSTed.
        # It should return an HttpResponse.
        new_message = Message(
            from_email = form.cleaned_data['from_email'],
            name = form.cleaned_data['name'],
            message = form.cleaned_data['message'],
        )
        new_message.save()
        # form.send_email()
        return super().form_valid(form)
