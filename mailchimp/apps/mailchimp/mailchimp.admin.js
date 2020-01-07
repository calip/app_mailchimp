/**
 * mailchimp - Javascript admin controller class
 * 
 * Mailchimp is the leading email marketing platform, that lets you send out fully customized email and newsletter campaigns to your subscribers. It is an imperative tool to build and follow through on your sales funnel, and helps you create and maintain lasting relations with your site visitors and customers. 
 *
 * @copyright 2019 calip
 *
 * @license MIT
 *
 * @package mailchimp
 * @version 1.0
 * @author  Alip <asalip.putra@gmail.com>
 * @link    https://github.com/calip/app_mailchimp
 */
SCHLIX.CMS.mailchimpAdminController = class extends SCHLIX.CMS.BaseController  {  
    /**
     * Constructor
     */
    constructor ()
    {
        super("mailchimp");
    };

    onDOMReady (event)
    {
        SCHLIX.Event.on('btn_test_connection', 'click', this.onTestConnectionClick, this, true);
    };

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

    /**
     * Datatable row format: item title
     * @param {type} elCell
     * @param {type} oRecord
     * @param {type} oColumn
     * @param {type} oData
     * @param {type} oDataTable
     * @returns {undefined}
     */
    static formatDataTableCell_DefaultTitleColumn  (elCell, oRecord, oColumn, oData) {

        var field_title = SCHLIX.Util.isUndefined(this.parentControl.element_data["field-item_title"]) ? "title" : this.parentControl.element_data["field-item_title"];
        var odata_id = oRecord.getData("id");
        var odata_cid = oRecord.getData("cid");
        var itemTitle = oRecord.getData(field_title); // oRecord.getData("title");
        var itemLink = site_httpbase;
        if (itemTitle == null)
        {
            SCHLIX.log("formatDataTableCell_DefaultTitleColumn cannot process a null title", 'warn');
            return;
        }
        if (itemTitle.length > 40)
            itemTitle = itemTitle.substr(0, 40) + '...';
        var app_name = this.parentControl.app_name;
        if (odata_cid > 0)
        {
            SCHLIX.CMS.__default_formatFolderInDataTable(app_name, elCell, oRecord, itemTitle, site_httpbase + this.parentControl.schlix_application_url + 'action=editcategory&id=' + odata_cid);
        } else
        {
            // console.log(oRecord);
            var the_id = oRecord.getData("id");
            var theValue = 'i' + the_id;
            if (itemTitle === '')
                itemTitle = '(Untitled)';
            var icon = "<i class =\"far fa-file-alt fa-2x\"></i>";

            itemLink += this.parentControl.schlix_application_url + 'action=edititem&id=' + the_id;
            var item_class = (oRecord.getData('id')==1 || oRecord.getData('virtual_filename') == 'home') ? 'html_home' : 'dragdrop';
            var preview_link = oRecord.getData("preview_link");
            var display_preview_link = '';
            if (SCHLIX.Util.isString(preview_link))
            {
                var preview_icon = "<i class=\"fa fa-eye\"></i> ";
                display_preview_link = '<div style="float:right;margin-left:4em">' +  '<a target="_blank" href="' + preview_link + '">' + preview_icon +  '</a>' + '</div>';
            }
            if (itemTitle)
                itemTitle = SCHLIX.Util.escapeHTML(itemTitle);            

            elCell.innerHTML = '<a class="' + item_class + '" id="' + app_name + "-lnk-" + theValue + '" data-dragdrop-id="' + theValue + '" title="Click here to edit this item" href="' + itemLink + '">' + " " + icon + " " + itemTitle + '</a>' + display_preview_link;
        }
    };
    
    
    static formatDataTableCell_CheckBox (elCell, oRecord, oColumn, oData) {
                var theID = '';
                var theValue = '';

                var app_name = this.parentControl.app_name;
                if (oRecord.getData("cid") > 0)
                {
                    theID = app_name + '-select-cid' + oRecord.getData("cid");
                    theValue = 'c' + oRecord.getData("cid");
                }
                else
                {
                    theID = app_name + '-select-id' + oRecord.getData("id");
                    theValue = 'i' + oRecord.getData("id");
                }

                elCell.innerHTML = '<input type="checkbox" class="' + app_name + '-chkselections" name="' + app_name + '-chkselections[]" id="' + theID + '"  value="' + theValue + '" />';
    }; 

    onTestConnectionClick(event)
    {
        var mailchimp_api = SCHLIX.Dom.get('str_mailchimp_api_key').value;
        var postData = "_csrftoken=" + _csrftoken + '&mailchimp_api=' +mailchimp_api;
        
        var request = SCHLIX.Ajax.POST( site_httpbase + "/admin/app/" + this.app_name + "?action=testconnection",
                {success: this.onGetTestConnectionResult, failure: this.onFailedConnectionTest, scope: this}, postData
                );
    }; 

    onGetTestConnectionResult(o)
    {
        var response = this.json_decode(o.responseText);
        if (response.status == 200)
        {
            this.runCommand("config");
        }
        else {
            alert('Error: Mailchimp Account not found');
            this.runCommand("config");
        }
    };

    onFailedConnectionTest(o)
    {
        alert('Error: Could not connect to mailchimp');
    }; 
    
    runCommand (command, evt)
    {
        //if (evt.type == 'contextmenu')
        var open_in_new_window = is_rightclick_event(evt);
        switch (command)
        {
            case 'new-item':
                this.redirectToCMSCommand("newitem",open_in_new_window);
                return true;
                break;
            case 'new-category':
                this.redirectToCMSCommand("newcategory",open_in_new_window);
                return true;
                break;
            case 'edit-current-category':
                var target = evt.target;                
                window.location = target.href;
                return true;
                break;                                                
            case 'config':
                this.redirectToCMSCommand("editconfig",open_in_new_window);
                return true;
                break;
            default:
                return super.runCommand(command,evt);
                break;
        }
    }
};