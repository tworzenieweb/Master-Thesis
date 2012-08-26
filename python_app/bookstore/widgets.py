from django.forms.widgets import SelectMultiple
from django.forms.fields import MultipleChoiceField
from django.forms import ModelForm
from djangotoolbox.fields import ListField
from django.utils.safestring import mark_safe
from settings import GLOBAL_MEDIA_DIRS


class ModelListField(ListField):
    def formfield(self, **kwargs):
        return FormListField(**kwargs)

class ListFieldWidget(SelectMultiple):
    class Media:
        css = {
            'all': (
                    
                '/media/admin/css/multi-select.css',
            )
        }
        js = (
            'https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js',
            '/media/admin/js/jquery.multi-select.js',
        )


    def render(self, name, value, attrs=None):
        rendered = super(SelectMultiple, self).render(name, value, attrs)
        return rendered + mark_safe(u'''<script type="text/javascript">
            $(function () {
                var elem = $('#id_%(name)s');
                elem.multiSelect();
            });
            </script>''' % {'name':name})

class FormListField(MultipleChoiceField):
    """
    This is a custom form field that can display a ModelListField as a Multiple Select GUI element.
    """
    widget = ListFieldWidget

    def clean(self, value):
        #TODO: clean your data in whatever way is correct in your case and return cleaned data instead of just the value
        return value