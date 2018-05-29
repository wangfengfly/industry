<div class="block" id="block-tables">

                <div class="secondary-navigation">
                    <ul class="wat-cf">
                        <li class="first"><a href="news">Listing</a></li>
                        <li><a href="news/create/">New record</a></li>
                    </ul>
                </div>

                <div class="content">
                    <div class="inner">
						<h3>Details of {$table_name}, record #{$id}</h3>

						<table class="table" width="50%">
                        	<thead>
                                <th width="20%">Field</th>
                                <th>Value</th>
                        	</thead>
						    <tr class="{cycle values='odd,even'}">
                            <td>{$news_fields.id}:</td>
                            <td>{$news_data.id}</td>
                        </tr><tr class="{cycle values='odd,even'}">
                            <td>{$news_fields.menu_id}:</td>
                            <td>{$news_data.menu_id}</td>
                        </tr><tr class="{cycle values='odd,even'}">
                            <td>{$news_fields.pub_time}:</td>
                            <td>{$news_data.pub_time}</td>
                        </tr><tr class="{cycle values='odd,even'}">
                            <td>{$news_fields.title}:</td>
                            <td>{$news_data.title}</td>
                        </tr><tr class="{cycle values='odd,even'}">
                            <td>{$news_fields.desc}:</td>
                            <td>{$news_data.desc}</td>
                        </tr><tr class="{cycle values='odd,even'}">
                            <td>{$news_fields.img_url}:</td>
                            <td>{$news_data.img_url}</td>
                        </tr><tr class="{cycle values='odd,even'}">
                            <td>{$news_fields.content}:</td>
                            <td>{$news_data.content}</td>
                        </tr><tr class="{cycle values='odd,even'}">
                            <td>{$news_fields.tags}:</td>
                            <td>{$news_data.tags}</td>
                        </tr><tr class="{cycle values='odd,even'}">
                            <td>{$news_fields.author}:</td>
                            <td>{$news_data.author}</td>
                        </tr>
						</table>
                        <div class="actions-bar wat-cf">
                            <div class="actions">
                                <a class="button" href="news/edit/{$id}">
                                    <img src="iscaffold/backend_skins/images/icons/application_edit.png" alt="Edit record"> Edit record
                                </a>
                            </div>
                        </div>
                    </div><!-- .inner -->
                </div><!-- .content -->
            </div><!-- .block -->
