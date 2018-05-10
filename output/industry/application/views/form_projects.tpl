<div class="block" id="block-tables">

                <div class="secondary-navigation">
                    <ul class="wat-cf">
                        <li class="first"><a href="projects">Listing</a></li>
                        <li class="{if $action_mode == 'create'}active{/if}"><a href="projects/create/">New record</a></li>
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

                        <form class="form" method='post' action='projects/{$action_mode}/{if isset($record_id)}{$record_id}{/if}' enctype="multipart/form-data">

                            
    	<div class="group">
            <label class="label">{$projects_fields.name}<span class="error">*</span></label>
    		<div>
    	       	<input class="text_field" type="text" maxlength="255" value="{if isset($projects_data)}{$projects_data.name}{/if}" name="name" />
    		</div>
    		
    	</div>
    
    	<div class="group">
            <label class="label">{$projects_fields.sshy1}<span class="error">*</span></label>
    		<div>
				{if isset($projects_data)}
					{html_options name=sshy1 options=$sshy_options selected=$projects_data.sshy1}
				{else}
					{html_options name=sshy1 options=$sshy_options selected=0}
				{/if}
    		</div>
    		
    	</div>
    
    	<div class="group">
            <label class="label">{$projects_fields.sshy2}<span class="error">*</span></label>
    		<div>
				{if isset($projects_data)}
					{html_options name=sshy2 options=$sshy_options selected=$projects_data.sshy2}
				{else}
					{html_options name=sshy2 options=$sshy_options selected=0}
				{/if}
    		</div>
    		
    	</div>
    
    	<div class="group">
            <label class="label">{$projects_fields.jsdw}<span class="error">*</span></label>
    		<div>
    	       	<input class="text_field" type="text" maxlength="255" value="{if isset($projects_data)}{$projects_data.jsdw}{/if}" name="jsdw" />
    		</div>
    		
    	</div>
    
    	<div class="group">
            <label class="label">{$projects_fields.jsdd}<span class="error">*</span></label>
    		<div>
				{if isset($projects_data)}
					{html_options name=jsdd options=$jsdd_options selected=$projects_data.jsdd}
				{else}
					{html_options name=jsdd options=$jsdd_options selected=0}
				{/if}
    		</div>
    		
    	</div>
    
    	<div class="group">
            <label class="label">{$projects_fields.tzztxz}<span class="error">*</span></label>
    		<div>
    	       	<input class="text_field" type="text" maxlength="255" value="{if isset($projects_data)}{$projects_data.tzztxz}{/if}" name="tzztxz" />
    		</div>
    		
    	</div>
    
    	<div class="group">
            <label class="label">{$projects_fields.tze}<span class="error">*</span></label>
    		<div>
    	       	<input class="text_field" type="text" maxlength="255" value="{if isset($projects_data)}{$projects_data.tze}{/if}" name="tze" />
    		</div>
    		
    	</div>
    
    	<div class="group">
            <label class="label">{$projects_fields.jsnr}<span class="error">*</span></label>
    		<div>
    	       	<input class="text_field" type="text" maxlength="255" value="{if isset($projects_data)}{$projects_data.jsnr}{/if}" name="jsnr" />
    		</div>
    		
    	</div>
    
    	<div class="group">
            <label class="label">{$projects_fields.jjzb}<span class="error">*</span></label>
    		<div>
    	       	<input class="text_field" type="text" maxlength="255" value="{if isset($projects_data)}{$projects_data.jjzb}{/if}" name="jjzb" />
    		</div>
    		
    	</div>
    
    	<div class="group">
            <label class="label">{$projects_fields.jssj1}<span class="error">*</span></label>
    		<div>
    	       	<input class="text_field" type="text" maxlength="255" value="{if isset($projects_data)}{$projects_data.jssj1}{/if}" name="jssj1" />
    		</div>
    		
    	</div>
    
    	<div class="group">
            <label class="label">{$projects_fields.jssj2}<span class="error">*</span></label>
    		<div>
    	       	<input class="text_field" type="text" maxlength="255" value="{if isset($projects_data)}{$projects_data.jssj2}{/if}" name="jssj2" />
    		</div>
    		
    	</div>
    
    	<div class="group">
            <label class="label">{$projects_fields.tags}<span class="error">*</span></label>
    		<div>
    	       	<input class="text_field" type="text" maxlength="255" value="{if isset($projects_data)}{$projects_data.tags}{/if}" name="tags" />
    		</div>
    		
    	</div>
    
    	<div class="group">
            <label class="label">{$projects_fields.xmxz}<span class="error">*</span></label>
    		<div>
				{if isset($projects_data)}
					{html_options name=xmxz options=$xmxz_options selected=$projects_data.xmxz}
				{else}
					{html_options name=xmxz options=$xmxz_options selected=0}
				{/if}
    		</div>
    		
    	</div>
    
    	<div class="group">
            <label class="label">{$projects_fields.ssyq}<span class="error">*</span></label>
    		<div>
    	       	<input class="text_field" type="text" maxlength="255" value="{if isset($projects_data)}{$projects_data.ssyq}{/if}" name="ssyq" />
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
