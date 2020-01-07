/**
 * Mailchimp is the leading email marketing platform, that lets you send out fully customized email and newsletter campaigns to your subscribers. It is an imperative tool to build and follow through on your sales funnel, and helps you create and maintain lasting relations with your site visitors and customers.
 * 
 * @copyright SCHLIX Web Inc
 *
 * @license GPLv2
 *
 * @package mailchimp
 * @version 1.3
 * @author  SCHLIX Web Inc <info@schlix.com>
 * @link    https://www.schlix.com
 */


class Mailchimp
{
    constructor()
    {
        SCHLIX.Event.onDOMReady(this.onDOMReady, this, true);
    }
    
    onDOMReady()
    {
      //  this.createForm();
        this.modifyDivForm();
        SCHLIX.Event.on('mailchimp-form','submit', this.submitNewsletter, this, true);
    }
    
    createElement(el_type, inner, attrs)
    {
        var v = document.createElement(el_type);
        for (var k in attrs){
            if (attrs.hasOwnProperty(k)) {
                 //alert("Key is " + k + ", value is" + target[k]);
                 v.setAttribute(k, attrs[k]);
            }
        }        
        if (inner && inner != '')
            v.innerHTML = inner;
        return v;
    }
    
    modifyDivForm()
    {
        var container = document.getElementById('s_c_h_l_i_x_mailchimp');
        var fc = container.innerHTML;
        
        var contact_form = this.createElement('form','',{'method':'get','id':'mailchimp-form'});
        contact_form.innerHTML = fc;
        container.innerHTML = '';
        container.appendChild(contact_form);
    }
    
    //----------------------------------------------------------------------------------------------------------//
    /**
     * Parse SCHLIX CMS Ajax Reply
     */
    json_decode(jsonstr)
    {
        if (jsonstr.replace(/\s/g, "") != "")
        {
            //  var data = eval('('+jsonstr+')'); // no more
            try
            {
                var data = JSON.parse(jsonstr);
                return data;
            }
            catch (exc)
            {
                alert('JSON Decode error: ' + exc);
                return null;
            }
        } else
        {
            alert('SCHLIX AJAX Communication Error.\nServer returns an empty string. Please take a screenshot and e-mail technical support');
            return false;
        }
    };

    refreshWindow()
    {
        window.location.reload(true);
    }

    onNewsletterSubmitted(o)
    {
        var response = this.json_decode(o.responseText);
        console.log(response.status, response.data);
        if (response.status == 200)
        {
            var data = response.data;
            var err = SCHLIX.Dom.get('s_c_h_l_i_x_mailchimp_result');
            err.className = '';
            err.classList.add('alert');
            err.classList.add('alert-success');
            err.innerHTML = '<p><i class="fa fa-check"></i> ' + data.email_address + ' Thank you for subscribing. check your email for the confirmation message</p>';
            document.getElementById('s_c_h_l_i_x_mailchimp_inner').style.display = 'none';
            setTimeout(this.refreshWindow, 2000);
     
        } else if (response.status == 300)
        {
            
            var data = response.data;
            var err = SCHLIX.Dom.get('s_c_h_l_i_x_mailchimp_result');
            err.className = '';
            err.classList.add('alert');
            err.classList.add('alert-danger');
            var str = '<p><i class="fa fa-exclamation-circle"></i> ' + data + '</p>';
            err.innerHTML = str;
        } else  
        {
            alert('Ajax error');
        }        
        
    }; // end func
///////////////////////////////////////////////////////////
    onNewsletterRejected (o)
    {
            var err = SCHLIX.Dom.get('s_c_h_l_i_x_mailchimp_result');
            err.className = '';
            err.classList.add('alert');
            err.classList.add('alert-danger');
            err.innerHTML = '<p><i class="fa fa-exclamation-circle"></i> Newsletter cannot be added</p>';        
    }; // end func
    
    submitNewsletter(e)
    {
        
        var valid = false;
        var form = SCHLIX.Dom.get('mailchimp-form');
        if(!form.checkValidity()) {
            e.preventDefault();
            e.stopPropagation();
            return false;
            // show validation errors
        } else
        {
            var input_firstname = document.getElementById('mailchimp-firstname').value;
            var input_lastname = document.getElementById('mailchimp-lastname').value;
            var input_email = document.getElementById('mailchimp-email').value;
            var input_phone = document.getElementById('mailchimp-phone').value;
            
            var input_verification_el = document.getElementById('mailchimp-verify');
            
            SCHLIX.Cookie.set('mailchimp-firstname', input_firstname);
            SCHLIX.Cookie.set('mailchimp-lastname', input_lastname);
            SCHLIX.Cookie.set('mailchimp-email', input_email);
            SCHLIX.Cookie.set('mailchimp-phone', input_phone);
            
          var postData = "_csrftoken=" + _csrftoken + '&firstname=' + encodeURIComponent(input_firstname) + 
              '&lastname=' + encodeURIComponent(input_lastname) + 
              '&email=' + encodeURIComponent(input_email) + 
              '&phone=' + encodeURIComponent(input_phone);
              
          if (input_verification_el)
          {
              postData += '&verification_code=' + encodeURIComponent(input_verification_el.value);
          }
  
          var request = SCHLIX.Ajax.POST( site_httpbase + "/mailchimp/action/postentry",
                  {success: this.onNewsletterSubmitted, failure: this.onNewsletterRejected, scope: this}, postData);
  
              e.preventDefault();
              e.stopPropagation();
  
              return false;
        }
        
    }
    
}

var __mailchimp = new Mailchimp();