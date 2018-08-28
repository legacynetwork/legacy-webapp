from django.views.generic import TemplateView, FormView

from .forms import MessageForm, EmailForm
from .models import Message, EmailSuscriber


class HomeView(TemplateView):

    template_name = 'home.html'


class EmailView(FormView):
    template_name = 'thanks_email.html'
    form_class = EmailForm
    success_url = '/#subscribe'

    def form_valid(self, form):
        # This method is called when valid form data has been POSTed.
        # It should return an HttpResponse.
        new_email = EmailSuscriber(
            email = form.cleaned_data['email']
        )
        new_email.save()
        return super().form_valid(form)


class MessageView(FormView):
    template_name = 'thanks_message.html'
    form_class = MessageForm
    success_url = '/#contact'

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
