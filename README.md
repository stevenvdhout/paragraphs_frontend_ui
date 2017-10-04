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