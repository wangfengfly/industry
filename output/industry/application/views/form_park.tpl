<div class="block" id="block-tables">

                <div class="secondary-navigation">
                    <ul class="wat-cf">
                        <li class="first"><a href="park">Listing</a></li>
                        <li class="{if $action_mode == 'create'}active{/if}"><a href="park/create/">New record</a></li>
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

                        <form class="form" method='post' action='park/{$action_mode}/{if isset($record_id)}{$record_id}{/if}' enctype="multipart/form-data">

                            
    	<div class="group">
            <label class="label">{$park_fields.identifier}<span class="error">*</span></label>
    		<div>
    	       	<input class="text_field" type="text" maxlength="255" value="{if isset($park_data)}{$park_data.identifier}{/if}" name="identifier" />
    		</div>
    		
    	</div>
    
    	<div class="group">
            <label class="label">{$park_fields.code}<span class="error">*</span></label>
    		<div>
    	       	<input class="text_field" type="text" maxlength="255" value="{if isset($park_data)}{$park_data.code}{/if}" name="code" />
    		</div>
    		
    	</div>
    
    	<div class="group">
            <label class="label">{$park_fields.name}<span class="error">*</span></label>
    		<div>
    	       	<input class="text_field" type="text" maxlength="255" value="{if isset($park_data)}{$park_data.name}{/if}" name="name" />
    		</div>
    		
    	</div>
    
    	<div class="group">
            <label class="label">{$park_fields.create_time}<span class="error">*</span></label>
    		<div>
    	       	<input class="text_field" type="text" maxlength="255" value="{if isset($park_data)}{$park_data.create_time}{/if}" name="create_time" />
    		</div>
    		
    	</div>
    
    	<div class="group">
            <label class="label">{$park_fields.area}<span class="error">*</span></label>
    		<div>
    	       	<input class="text_field" type="text" maxlength="255" value="{if isset($park_data)}{$park_data.area}{/if}" name="area" />
    		</div>
    		
    	</div>
    
    	<div class="group">
            <label class="label">{$park_fields.prime_ind1}<span class="error">*</span></label>
    		<div>
    	       	<input class="text_field" type="text" maxlength="255" value="{if isset($park_data)}{$park_data.prime_ind1}{/if}" name="prime_ind1" />
    		</div>
    		
    	</div>
    
    	<div class="group">
            <label class="label">{$park_fields.prime_ind2}<span class="error">*</span></label>
    		<div>
    	       	<input class="text_field" type="text" maxlength="255" value="{if isset($park_data)}{$park_data.prime_ind2}{/if}" name="prime_ind2" />
    		</div>
    		
    	</div>
    
    	<div class="group">
            <label class="label">{$park_fields.prime_ind3}<span class="error">*</span></label>
    		<div>
    	       	<input class="text_field" type="text" maxlength="255" value="{if isset($park_data)}{$park_data.prime_ind3}{/if}" name="prime_ind3" />
    		</div>
    		
    	</div>
    
    	<div class="group">
            <label class="label">{$park_fields.prime_ind4}<span class="error">*</span></label>
    		<div>
    	       	<input class="text_field" type="text" maxlength="255" value="{if isset($park_data)}{$park_data.prime_ind4}{/if}" name="prime_ind4" />
    		</div>
    		
    	</div>
    
    	<div class="group">
            <label class="label">{$park_fields.intro}<span class="error">*</span></label>
    		<div>
    	       	<input class="text_field" type="text" maxlength="255" value="{if isset($park_data)}{$park_data.intro}{/if}" name="intro" />
    		</div>
    		
    	</div>
    
    	<div class="group">
            <label class="label">{$park_fields.url}<span class="error">*</span></label>
    		<div>
    	       	<input class="text_field" type="text" maxlength="255" value="{if isset($park_data)}{$park_data.url}{/if}" name="url" />
    		</div>
    		
    	</div>
    
    	<div class="group">
            <label class="label">{$park_fields.phone}<span class="error">*</span></label>
    		<div>
    	       	<input class="text_field" type="text" maxlength="255" value="{if isset($park_data)}{$park_data.phone}{/if}" name="phone" />
    		</div>
    		
    	</div>
    
    	<div class="group">
            <label class="label">{$park_fields.email}<span class="error">*</span></label>
    		<div>
    	       	<input class="text_field" type="text" maxlength="255" value="{if isset($park_data)}{$park_data.email}{/if}" name="email" />
    		</div>
    		
    	</div>
    
    	<div class="group">
            <label class="label">{$park_fields.wechat}<span class="error">*</span></label>
    		<div>
    	       	<input class="text_field" type="text" maxlength="255" value="{if isset($park_data)}{$park_data.wechat}{/if}" name="wechat" />
    		</div>
    		
    	</div>
    
    	<div class="group">
            <label class="label">{$park_fields.companies}<span class="error">*</span></label>
    		<div>
    	       	<input class="text_field" type="text" maxlength="255" value="{if isset($park_data)}{$park_data.companies}{/if}" name="companies" />
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
