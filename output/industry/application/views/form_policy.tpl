<div class="block" id="block-tables">

                <div class="secondary-navigation">
                    <ul class="wat-cf">
                        <li class="first"><a href="policy">Listing</a></li>
                        <li class="{if $action_mode == 'create'}active{/if}"><a href="policy/create/">New record</a></li>
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

                        <form class="form" method='post' action='policy/{$action_mode}/{if isset($record_id)}{$record_id}{/if}' enctype="multipart/form-data">

                            
    	<div class="group">
            <label class="label">{$policy_fields.pub_time}<span class="error">*</span></label>
    		<div>
    	       	<input class="text_field" type="text" maxlength="255" value="{if isset($policy_data)}{$policy_data.pub_time}{/if}" name="pub_time" />
    		</div>
    		
    	</div>
    
    	<div class="group">
            <label class="label">{$policy_fields.ind_id}<span class="error">*</span></label>
    		<div>
    	       	<input class="text_field" type="text" maxlength="255" value="{if isset($policy_data)}{$policy_data.ind_id}{/if}" name="ind_id" />
    		</div>
    		
    	</div>
    
    	<div class="group">
            <label class="label">{$policy_fields.pid}<span class="error">*</span></label>
    		<div>
    	       	<input class="text_field" type="text" maxlength="255" value="{if isset($policy_data)}{$policy_data.pid}{/if}" name="pid" />
    		</div>
    		
    	</div>
    
    	<div class="group">
            <label class="label">{$policy_fields.department}<span class="error">*</span></label>
    		<div>
    	       	<input class="text_field" type="text" maxlength="255" value="{if isset($policy_data)}{$policy_data.department}{/if}" name="department" />
    		</div>
    		
    	</div>
    
    	<div class="group">
            <label class="label">{$policy_fields.title}<span class="error">*</span></label>
    		<div>
    	       	<input class="text_field" type="text" maxlength="255" value="{if isset($policy_data)}{$policy_data.title}{/if}" name="title" />
    		</div>
    		
    	</div>
    
    	<div class="group">
            <label class="label">{$policy_fields.content}<span class="error">*</span></label>
    		<div>
    	       	<input class="text_field" type="text" maxlength="255" value="{if isset($policy_data)}{$policy_data.content}{/if}" name="content" />
    		</div>
    		
    	</div>
    
    	<div class="group">
            <label class="label">{$policy_fields.attach_url}<span class="error">*</span></label>
    		<div>
    	       	<input class="text_field" type="text" maxlength="255" value="{if isset($policy_data)}{$policy_data.attach_url}{/if}" name="attach_url" />
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
