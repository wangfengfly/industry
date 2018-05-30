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
                {if isset($news_data)}
                {html_options name=menu_id options=$menus selected=$news_data.menu_id}
                {else}
                {html_options name=menu_id options=$menus selected=0}
                {/if}
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
                <!-- 加载编辑器的容器 -->
                <script id="content" name="content" type="text/plain">
                    {if isset($news_data)}
                    {$news_data.content}
                    {/if}
                </script>
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
    <!-- 配置文件 -->
    <script type="text/javascript" src="iscaffold/js/ueditor/ueditor.config.js"></script>
    <!-- 编辑器源码文件 -->
    <script type="text/javascript" src="iscaffold/js/ueditor/ueditor.all.min.js"></script>
    <!-- 实例化编辑器 -->
    <script type="text/javascript">
        var ue = UE.getEditor('content', {
            initialFrameHeight:600,//设置编辑器高度
            scaleEnabled:true
        });
        //这段要放在文本编辑器的实例化之后
        /*function click(){
         if (!UE.getEditor('content').hasContents()){
         alert('请先填写内容!');
         }else{
         document.setweb.info.value=UE.getEditor('editor').getContent();
         document.setweb.submit();
         }
         }*/
    </script>
            </div><!-- .block -->
