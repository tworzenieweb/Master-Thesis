import json

from piston.decorator import decorator
from piston.resource import Resource
from piston.utils import rc, FormValidationError
from django.http import HttpResponse

def validate(v_form, operation='POST'):
    """ This fetches the submitted data for the form 
        from request.data because we always expect JSON data
        It is otherwise a copy of piston.util.validate.
    """
        
    @decorator
    def wrap(f, self, request, *a, **kwa):
        
        # Assume that the JSON response is in request.data
        # Probably want to do a getattr(request, data, None)
        #   and raise an exception if data is not found
        form = v_form(request.data)

        if form.is_valid():
            setattr(request, 'form', form)
            return f(self, request, *a, **kwa)
        else:
            raise FormValidationError(form)
    return wrap

class Resource(Resource):
    
    # headers sent in all responses
    cors_headers = [
        ('Access-Control-Allow-Origin',     'http://thesis.web.dev'),
        ('Access-Control-Allow-Headers',    'Authorization'),
        ('Access-Control-Allow-Credentials','true')
    ]

    # headers sent in pre-flight responses
    preflight_headers = cors_headers + [
        ('Access-Control-Allow-Methods',    'GET'),
    ]

    def __call__(self, request, *args, **kwargs):

        request_method = request.method.upper()

        # intercept OPTIONS method requests
        if request_method == "OPTIONS":
            # preflight requests don't need a body, just headers
            resp = HttpResponse()

            # add headers to the empty response
            for hk, hv in self.preflight_headers:
                resp[hk] = hv

        else:
            # otherwise, behave as if we called  the base Resource
            resp = super(Resource, self).__call__(request, *args, **kwargs)

            # slip in the headers after we get the response
            # from the handler
            for hk, hv in self.cors_headers:
                resp[hk] = hv

        return resp
    
    def form_validation_response(self, e):
        """
        Turns the error object into a serializable construct.
        All credit for this method goes to Jacob Kaplan-Moss
        """
        
        # Create a 400 status_code response
        resp = rc.BAD_REQUEST
        
        
        # Serialize the error.form.errors object
        json_errors = json.dumps(
            dict(
                (k, map(unicode, v))
                for (k,v) in e.form.errors.iteritems()
            )
        )
        resp.content = json_errors
        resp['Content-Type'] = 'application/json'
        return resp
    
