<div class="block" id="block-tables">

                <div class="secondary-navigation">
                    <ul class="wat-cf">
                        <li class="first"><a href="news">Listing</a></li>
                        <li class="{if $action_mode == 'create'}active{/if}"><a href="news/create/">New record</a></li>
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

                        <form class="form" method='post' action='news/{$action_mode}/{if isset($record_id)}{$record_id}{/if}' enctype="multipart/form-data">

                            
    	<div class="group">
            <label class="label">{$news_fields.menu_id}<span class="error">*</span></label>
    		<div>
    	       	<input class="text_field" type="text" maxlength="255" value="{if isset($news_data)}{$news_data.menu_id}{/if}" name="menu_id" />
    		</div>
    		
    	</div>
    
    	<div class="group">
            <label class="label">{$news_fields.pub_time}<span class="error">*</span></label>
    		<div>
    	       	<input class="text_field" type="text" maxlength="255" value="{if isset($news_data)}{$news_data.pub_time}{/if}" name="pub_time" />
    		</div>
    		
    	</div>
    
    	<div class="group">
            <label class="label">{$news_fields.title}<span class="error">*</span></label>
    		<div>
    	       	<input class="text_field" type="text" maxlength="255" value="{if isset($news_data)}{$news_data.title}{/if}" name="title" />
    		</div>
    		
    	</div>
    
    	<div class="group">
            <label class="label">{$news_fields.desc}<span class="error">*</span></label>
    		<div>
    	       	<input class="text_field" type="text" maxlength="255" value="{if isset($news_data)}{$news_data.desc}{/if}" name="desc" />
    		</div>
    		
    	</div>
    
    	<div class="group">
            <label class="label">{$news_fields.img_url}<span class="error">*</span></label>
    		<div>
    	       	<input class="text_field" type="text" maxlength="255" value="{if isset($news_data)}{$news_data.img_url}{/if}" name="img_url" />
    		</div>
    		
    	</div>
    
    	<div class="group">
            <label class="label">{$news_fields.content}<span class="error">*</span></label>
    		<div>
    	       	<input class="text_field" type="text" maxlength="255" value="{if isset($news_data)}{$news_data.content}{/if}" name="content" />
    		</div>
    		
    	</div>
    
    	<div class="group">
            <label class="label">{$news_fields.tags}<span class="error">*</span></label>
    		<div>
    	       	<input class="text_field" type="text" maxlength="255" value="{if isset($news_data)}{$news_data.tags}{/if}" name="tags" />
    		</div>
    		
    	</div>
    
    	<div class="group">
            <label class="label">{$news_fields.author}<span class="error">*</span></label>
    		<div>
    	       	<input class="text_field" type="text" maxlength="255" value="{if isset($news_data)}{$news_data.author}{/if}" name="author" />
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
