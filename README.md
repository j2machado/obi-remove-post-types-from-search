Obi Remove Post Types from Search
=
The problem: many plugins register custom post types on your website for their data flow. Some of those post types are publicly accessible. In some cases, you don't want your users accessing that data from the WordPress search. Let's say, that is not the way you intend users accessing the data on your site.

The solution: exclude some post types from the WordPress search.

This plugin does just that. The current stable version now is working.

A demo image:

![Alt Obi Remove Post Types from Search admin options screenshot](https://obijuan.dev/wp-content/uploads/2023/06/obi-remove-post-types-from-search.png)

Behind the scenes, we retrieve the available public post types in the website and store them in an option.  

If a plugin that registers custom post types is removed, then those specific post types are removed from the option as well.  

If a new plugin later in time is added which adds public custom post types, these are added to the options as well.  

Post types that are search-enabled, will have their respective checkbox as 'checked'.

If there is a post type that is unchecked, and you want to include it in the WordPress search, simply check the checkbox and save the changes.