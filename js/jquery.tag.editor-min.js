/*
@inital author: Karl-Johan Sjögren / http://blog.crazybeavers.se/
@contributor: Joost Elfering / http://yopefonic.wordpress.com/
@url: http://blog.crazybeavers.se/wp-content/demos/jquery.tag.editor/
@license: Creative Commons License - ShareAlike http://creativecommons.org/licenses/by-sa/3.0/
@version: 1.4.1
*/
(function(jQuery) { jQuery.fn.tagEditor = function(options) { var defaults = { separator: ",", items: [], className: "tagEditor", confirmRemoval: false, confirmRemovalText: "Do you really want to remove the tag?", completeOnSeparator: false, completeOnBlur: false, tagsBeforeField: false, initialParse: true, imageTag: false, imageTagUrl: "", continuousOutputBuild: false }; options = jQuery.extend(defaults, options); var listBase, textBase = this, hiddenText; var itemBase = []; return this.each(function() { function addTag(tag) { tag = jQuery.trim(tag); for (var i = 0; i < itemBase.length; i++) { if (itemBase[i].toLowerCase() == tag.toLowerCase()) { return false; } } var item = jQuery(document.createElement("li")); item.text(tag); item.attr("title", "Remove tag"); if (options.imageTag) { item.append('<img src="' + options.imageTagUrl + '">'); } item.click(function() { if (options.confirmRemoval) { if (!confirm(options.confirmRemovalText)) { return; } } item.remove(); parse(); }); listBase.append(item); return true; } function resetTags() { itemBase = []; listBase.html(""); textBase.val(""); hiddenText.val(""); for (var i = 0; i < options.items.length; i++) { addTag(jQuery.trim(options.items[i])); } parse(); } function buildArray() { itemBase = []; var items = jQuery("li", listBase); for (var i = 0; i < items.length; i++) { itemBase.push(jQuery.trim(jQuery(items[i]).text())); } if (options.continuousOutputBuild) { hiddenText.val(itemBase.join(options.separator)); } } function parse() { var items = textBase.val().split(options.separator); for (var i = 0; i < items.length; i++) { var trimmedItem = jQuery.trim(items[i]); if (trimmedItem.length > 0) { addTag(trimmedItem); } } textBase.val(""); buildArray(); } function handleKeys(ev) { var keyCode = (ev.which) ? ev.which : ev.keyCode; if (options.completeOnSeparator) { if (String.fromCharCode(keyCode) == options.separator) { parse(); return false; } } switch (keyCode) { case 13: if (jQuery.trim(textBase.val()) != "") { parse(); return false; } return true; default: return true; } } jQuery.fn.extend({ tagEditorGetTags: function() { return itemBase.join(options.separator); }, tagEditorResetTags: function() { resetTags(); }, tagEditorAddTag: function(tag) { return addTag(tag); } }); hiddenText = jQuery(document.createElement("input")); hiddenText.attr("type", "hidden"); if (options.continuousOutputBuild) { hiddenText.attr("name", textBase.attr("name")); textBase.attr("name", textBase.attr("name") + "_old"); } textBase.after(hiddenText); listBase = jQuery(document.createElement("ul")); listBase.attr("class", options.className); if (options.tagsBeforeField) { jQuery(this).before(listBase); } else { jQuery(this).after(listBase); } for (var i = 0; i < options.items.length; i++) { addTag(jQuery.trim(options.items[i])); } if (options.initialParse) { parse(); } if (options.completeOnBlur) { jQuery(this).blur(parse); } buildArray(); jQuery(this).keypress(handleKeys); var form = jQuery(this).parents("form"); if (!options.continuousOutputBuild) { form.submit(function() { parse(); hiddenText.val(itemBase.join(options.separator)); hiddenText.attr("id", textBase.attr("id")); hiddenText.attr("name", textBase.attr("name")); textBase.attr("id", textBase.attr("id") + "_old"); textBase.attr("name", textBase.attr("name") + "_old"); }); } }); }; })(jQuery);