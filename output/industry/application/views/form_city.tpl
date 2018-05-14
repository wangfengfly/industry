<div class="block" id="block-tables">

                <div class="secondary-navigation">
                    <ul class="wat-cf">
                        <li class="first"><a href="city">Listing</a></li>
                        <li class="{if $action_mode == 'create'}active{/if}"><a href="city/create/">New record</a></li>
                    </ul>
                </div>

                <div class="content">
                    <div class="inner">
                        {if $action_mode == 'create'}
                            <h3>Add new record</h3>
                        {else}
                            <h3>Edit record: #{$record_id}</h3>
                        {/if}
                        {if isset($errors)}
                            <div class="flash">
                                <div class="message error">
                                    <p>{$errors}</p>
                                </div>
                            </div>
                        {/if}

                        <form class="form" method='post' action='city/{$action_mode}/{if isset($record_id)}{$record_id}{/if}' enctype="multipart/form-data">

                            
    	<div class="group">
            <label class="label">{$city_fields.name}<span class="error">*</span></label>
    		<div>
    	       	<input class="text_field" type="text" maxlength="255" value="{if isset($city_data)}{$city_data.name}{/if}" name="name" />
    		</div>
    		
    	</div>
    
    	<div class="group">
            <label class="label">{$city_fields.pid}<span class="error">*</span></label>
    		<div>
                {if isset($city_data)}
                    {html_options name=pid options=$provinces selected=$city_data.pid}
                {else}
                    {html_options name=pid options=$provinces selected=0}
                {/if}
    		</div>
    		
    	</div>
    

                            <div class="group navform wat-cf">
                                    <button class="button" type="submit">
                                        <img src="iscaffold/backend_skins/images/icons/tick.png" alt="Save"> Save
                                    </button>
                                    <span class="text_button_padding">or</span>
                                    <a class="text_button_padding link_button" href="javascript:window.history.back();">Cancel</a>
                            </div>
                        </form>
                    </div><!-- .inner -->
                </div><!-- .content -->
            </div><!-- .block -->
