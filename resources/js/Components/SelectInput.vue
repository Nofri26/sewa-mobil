<script setup>
import 'vue-select/dist/vue-select.css';
</script>

<style>
:root,
:host {
  /* Font dan ukuran */
  --vs-font-size: 1rem;
  --vs-line-height: 2;

  /* Search Input */
  --vs-search-input-color: #374151; /* Gray-700 */
  --vs-search-input-bg: #ffffff; /* White */
  --vs-search-input-placeholder-color: #9ca3af; /* Gray-400 */

  /* Disabled State */
  --vs-state-disabled-bg: #f9fafb; /* Gray-50 */
  --vs-state-disabled-color: #d1d5db; /* Gray-300 */
  --vs-state-disabled-controls-color: #9ca3af; /* Gray-400 */
  --vs-state-disabled-cursor: not-allowed;

  /* Borders */
  --vs-border-color: #d1d5db; /* Gray-300 */
  --vs-border-width: 1px;
  --vs-border-style: solid;
  --vs-border-radius: 0.375rem; /* Tailwind's rounded-md */

  /* Shadow */
  --vs-dropdown-box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05); /* Tailwind's shadow-sm */

  /* Selected */
  --vs-selected-bg: #f9fafb; /* Gray-50 */
  --vs-selected-color: #111827; /* Gray-900 */
  --vs-selected-border-color: #d1d5db; /* Gray-300 */

  /* Focus States */
  --vs-focus-ring-color: rgba(99, 102, 241, 0.5); /* Tailwind's indigo-500 focus ring */
  --vs-focus-ring-width: 3px;

  /* Dropdown */
  --vs-dropdown-bg: #ffffff; /* White */
  --vs-dropdown-color: #374151; /* Gray-700 */
  --vs-dropdown-min-width: 160px;
  --vs-dropdown-max-height: 350px;

  /* Options */
  --vs-dropdown-option-bg: #ffffff; /* White */
  --vs-dropdown-option-color: #374151; /* Gray-700 */
  --vs-dropdown-option-padding: 0.5rem 1rem; /* Tailwind spacing: p-2 pl-4 */

  /* Active State */
  --vs-dropdown-option--active-bg: #6366f1; /* Indigo-500 */
  --vs-dropdown-option--active-color: #ffffff; /* White */

  /* Deselect State */
  --vs-dropdown-option--deselect-bg: #ef4444; /* Red-500 */
  --vs-dropdown-option--deselect-color: #ffffff; /* White */

  /* Transitions */
  --vs-transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1); /* Tailwind's default timing */
  --vs-transition-duration: 150ms;
}

</style>
