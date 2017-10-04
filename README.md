# Paragraphs Frontend ui

Paragraphs Frontend ui is intended as a POC for editing paragraphs from the frontend.

It is based on ideas from geysir and landingspage, but is based on paragraphs_edit.
That way it has better support for QuickEdit

The following features are currently available in the frontend trough contextual links:

* Quick Edit
* Editing of the content inside a modal
* Edit a different form mode 'Settings' from te settings tray
* Move paragraph items up/down
* Duplicate paragraph items
* Add a new item from a paragraph browser inside the settings tray

## Screen recorings

Some gifs demonstrating the magic

### Editing paragraphs settings & quick edit
![alt text] (https://www.dropbox.com/s/qg640za04222lg4/settings%26quickedit.gif?raw=1 "Settings & Quickedit")

### Duplicating & moving paragraphs
https://www.dropbox.com/s/wdqvxdki22jgph4/move%26duplicate.gif?dl=0

### Adding paragraphs
https://www.dropbox.com/s/aiivqhjvgmhy8fl/add-content.gif?dl=0

### Using webforms with paragraphs
https://www.dropbox.com/s/oo2prxw57835dka/webform.gif?dl=0


## Install

### Clean Drupal

In a clean drupal you can install the paragraphs_frontend_ui_example for a setup.

After enabling the modules, visit these pages to add default content for the paragraph types:

admin/structure/paragraphs_type/text_with_image/browsers/default-content
admin/structure/paragraphs_type/columns/browsers/default-content

### Existing Drupal

You can also install the poc inside an existing drupal project with paragraphs.

First add a new Form mode 'Settings' to each paragraph type.

Then configure the Paragraph browser module.

Install paragraphs_frontend_ui

## Known problems

For now it only works for non-multilingual websites.
For now only admins can edit the frontend like this.

The goal is to use this POC to start on conversation about frontend editing capabilities  for Paragraphs.
