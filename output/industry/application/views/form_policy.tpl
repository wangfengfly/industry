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
    	       	{*<input class="text_field" type="text" maxlength="255" value="{if isset($policy_data)}{$policy_data.content}{/if}" name="content" />*}
                <!-- 加载编辑器的容器 -->
                <script id="content" name="content" type="text/plain">
                </script>
    		</div>
    		
    	</div>
    
    	{*<div class="group">
            <label class="label">{$policy_fields.attach_url}<span class="error">*</span></label>
    		<div>
    	       	<input class="text_field" type="text" maxlength="255" value="{if isset($policy_data)}{$policy_data.attach_url}{/if}" name="attach_url" />
    		</div>
    		
    	</div>*}
                            <input class="text_field" type="hidden" maxlength="255" value="0" name="attach_url" />
    

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
        var ue = UE.getEditor('content');
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
