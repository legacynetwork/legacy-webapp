from django import forms


class MessageForm(forms.Form):
    name = forms.CharField()
    from_email = forms.EmailField()
    message = forms.CharField(widget=forms.Textarea)


class EmailForm(forms.Form):
    email = forms.EmailField()
