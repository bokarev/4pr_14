/*
  Copyright 2012 Google Inc. All Rights Reserved.

  Licensed under the Apache License, Version 2.0 (the "License");
  you may not use this file except in compliance with the License.
  You may obtain a copy of the License at

      http://www.apache.org/licenses/LICENSE-2.0

  Unless required by applicable law or agreed to in writing, software
  distributed under the License is distributed on an "AS IS" BASIS,
  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
  See the License for the specific language governing permissions and
  limitations under the License.
*/

define(['jquery', '../utils', '../constants', '../globals'], function($, utils, constants, globals) {
  return {
    needsPlaylist: true,
    init: function() {
      $('body').on({
        click: function() {
          $(this).attr('disabled', true);
          utils.addVideoToPlaylist(globals.hashParams.playlist, $(this).attr('data-video-id'));

          window._gaq.push(['_trackEvent', 'Admin', 'Approve']);

          utils.animateModeration($(this).closest('li'), $('li[data-state=approved]'));
        }
      }, '#pending-panel input.approve');

      $('body').on({
        click: function() {
          $(this).attr('disabled', true);
          utils.addVideoToPlaylist(globals.rejectedPlaylistId, $(this).attr('data-video-id'));

          window._gaq.push(['_trackEvent', 'Admin', 'Reject']);

          utils.animateModeration($(this).closest('li'), $('li[data-state=rejected]'));
        }
      }, '#pending-panel input.reject');
    },
    display: function() {
      $('#tabs').show();
      $('#switch').show();

      utils.getPlaylists(function() {
        utils.getStateOfSubmissions(function(state) {
          if (state) {
            var lis = [];

            $.each(state.pendingIds, function() {
              var metadata = state.videoIdToMetadata[this];
              if (metadata) {
                metadata.buttonsHtml = utils.format('<input type="button" class="approve" value="Approve" data-video-id="{0}"><input type="button" class="reject" value="Reject" data-video-id="{0}">', this);

                lis.push(utils.format(constants.ADMIN_VIDEO_LI_TEMPLATE, metadata));
              }
            });

            $('#pending-videos').html(lis.join(''));

            $('#moderation-message').text(utils.format('{0} {1} pending moderation.', lis.length, lis.length == 1 ? 'video is' : 'videos are')).show();
          } else {
            utils.showMessage(utils.format('Unable to determine submission state. Is the "{0}" playlist missing?', constants.REJECTED_VIDEOS_PLAYLIST));
          }
        });
      });
    }
  };
});