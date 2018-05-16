<div class="block" id="block-tables">

                <div class="secondary-navigation">
                    <ul class="wat-cf">
                        <li class="first"><a href="economy">Listing</a></li>
                        <li class="{if $action_mode == 'create'}active{/if}"><a href="economy/create/">New record</a></li>
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

                        <form class="form" method='post' action='economy/{$action_mode}/{if isset($record_id)}{$record_id}{/if}' enctype="multipart/form-data">

                            
    	<div class="group">
            <label class="label">{$economy_fields.park_id}<span class="error">*</span></label>
    		<div>
    	       	<input class="text_field" type="text" maxlength="255" value="{if isset($economy_data)}{$economy_data.park_id}{/if}" name="park_id" />
    		</div>
    		
    	</div>
    
    	<div class="group">
            <label class="label">{$economy_fields.year}<span class="error">*</span></label>
    		<div>
    	       	<input class="text_field" type="text" maxlength="255" value="{if isset($economy_data)}{$economy_data.year}{/if}" name="year" />
    		</div>
    		
    	</div>
    
    	<div class="group">
            <label class="label">{$economy_fields.pepole_count}<span class="error">*</span></label>
    		<div>
    	       	<input class="text_field" type="text" maxlength="255" value="{if isset($economy_data)}{$economy_data.pepole_count}{/if}" name="pepole_count" />
    		</div>
    		
    	</div>
    
    	<div class="group">
            <label class="label">{$economy_fields.gross}<span class="error">*</span></label>
    		<div>
    	       	<input class="text_field" type="text" maxlength="255" value="{if isset($economy_data)}{$economy_data.gross}{/if}" name="gross" />
    		</div>
    		
    	</div>
    
    	<div class="group">
            <label class="label">{$economy_fields.delivery}<span class="error">*</span></label>
    		<div>
    	       	<input class="text_field" type="text" maxlength="255" value="{if isset($economy_data)}{$economy_data.delivery}{/if}" name="delivery" />
    		</div>
    		
    	</div>
    
    	<div class="group">
            <label class="label">{$economy_fields.total_assets}<span class="error">*</span></label>
    		<div>
    	       	<input class="text_field" type="text" maxlength="255" value="{if isset($economy_data)}{$economy_data.total_assets}{/if}" name="total_assets" />
    		</div>
    		
    	</div>
    
    	<div class="group">
            <label class="label">{$economy_fields.current_assets}<span class="error">*</span></label>
    		<div>
    	       	<input class="text_field" type="text" maxlength="255" value="{if isset($economy_data)}{$economy_data.current_assets}{/if}" name="current_assets" />
    		</div>
    		
    	</div>
    
    	<div class="group">
            <label class="label">{$economy_fields.debt}<span class="error">*</span></label>
    		<div>
    	       	<input class="text_field" type="text" maxlength="255" value="{if isset($economy_data)}{$economy_data.debt}{/if}" name="debt" />
    		</div>
    		
    	</div>
    
    	<div class="group">
            <label class="label">{$economy_fields.owners}<span class="error">*</span></label>
    		<div>
    	       	<input class="text_field" type="text" maxlength="255" value="{if isset($economy_data)}{$economy_data.owners}{/if}" name="owners" />
    		</div>
    		
    	</div>
    
    	<div class="group">
            <label class="label">{$economy_fields.revenue}<span class="error">*</span></label>
    		<div>
    	       	<input class="text_field" type="text" maxlength="255" value="{if isset($economy_data)}{$economy_data.revenue}{/if}" name="revenue" />
    		</div>
    		
    	</div>
    
    	<div class="group">
            <label class="label">{$economy_fields.profit}<span class="error">*</span></label>
    		<div>
    	       	<input class="text_field" type="text" maxlength="255" value="{if isset($economy_data)}{$economy_data.profit}{/if}" name="profit" />
    		</div>
    		
    	</div>
    
    	<div class="group">
            <label class="label">{$economy_fields.tax}<span class="error">*</span></label>
    		<div>
    	       	<input class="text_field" type="text" maxlength="255" value="{if isset($economy_data)}{$economy_data.tax}{/if}" name="tax" />
    		</div>
    		
    	</div>
    
    	<div class="group">
            <label class="label">{$economy_fields.loss}<span class="error">*</span></label>
    		<div>
    	       	<input class="text_field" type="text" maxlength="255" value="{if isset($economy_data)}{$economy_data.loss}{/if}" name="loss" />
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
