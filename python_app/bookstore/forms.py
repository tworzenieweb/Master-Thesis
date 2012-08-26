from django import forms
from bookstore.models import *
from django.forms import ModelForm
from django.contrib.auth.forms import UserCreationForm
from django.utils.translation import ugettext_lazy as _
class CommentForm(forms.ModelForm):
    class Meta:
        model = Comment
        exclude = ('user')
        
class BookForm(ModelForm):
    
    
    def __init__(self, *args, **kwargs):
        super(BookForm,self).__init__(*args, **kwargs)
        self.fields['categories'].widget.choices = [(i.pk, i) for i in Category.objects.all()]
        
        if self.instance.pk:
            self.fields['categories'].initial = self.instance.categories
            self.fields['authors'].initial = self.instance.authors
            
            
        self.fields['authors'].widget.choices = [(i.pk, i) for i in Author.objects.all()]
        
        

    class Meta:
        model = Book
        
class UserProfileForm(ModelForm):
    
    first_name = forms.CharField(max_length=30, required = True)
    last_name = forms.CharField(max_length=30, required = True)
    
    username = forms.RegexField(label=_("Username"), max_length=30, regex=r'^[\w.@+-]+$',
        help_text = _("Required. 30 characters or fewer. Letters, digits and @/./+/-/_ only."),
        error_messages = {'invalid': _("This value may contain only letters, numbers and @/./+/-/_ characters.")})

    def clean_username(self):
        username = self.cleaned_data["username"]
        try:
            User.objects.get(username=username)
        except User.DoesNotExist:
            return username
        raise forms.ValidationError(_("A user with that username already exists."))


    def save(self, commit=True):
        user = super(UserProfileForm, self).save(commit=False)
        user.set_password(self.cleaned_data["password"])
        if commit:
            user.save()
        return user
    
    class Meta:
        model = User
        fields = ['username', 'email', 'first_name', 'last_name', 'password']