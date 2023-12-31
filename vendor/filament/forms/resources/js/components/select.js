import Choices from 'choices.js'

export default function selectFormComponent({
    canSelectPlaceholder,
    isHtmlAllowed,
    getOptionLabelUsing,
    getOptionLabelsUsing,
    getOptionsUsing,
    getSearchResultsUsing,
    isAutofocused,
    isDisabled,
    isMultiple,
    hasDynamicOptions,
    hasDynamicSearchResults,
    livewireId,
    loadingMessage,
    maxItems,
    maxItemsMessage,
    noSearchResultsMessage,
    options,
    optionsLimit,
    placeholder,
    position,
    searchDebounce,
    searchingMessage,
    searchPrompt,
    searchableOptionFields,
    state,
    statePath,
}) {
    return {
        isSearching: false,

        select: null,

        selectedOptions: [],

        isStateBeingUpdated: false,

        state,

        init: async function () {
            this.select = new Choices(this.$refs.input, {
                allowHTML: isHtmlAllowed,
                duplicateItemsAllowed: false,
                itemSelectText: '',
                loadingText: loadingMessage,
                maxItemCount: maxItems ?? -1,
                maxItemText: (maxItemCount) =>
                    window.pluralize(maxItemsMessage, maxItemCount, {
                        count: maxItemCount,
                    }),
                noChoicesText: searchPrompt,
                noResultsText: noSearchResultsMessage,
                placeholderValue: placeholder,
                position: position ?? 'auto',
                removeItemButton: canSelectPlaceholder,
                renderChoiceLimit: optionsLimit,
                searchFields: searchableOptionFields ?? ['label'],
                searchPlaceholderValue: searchPrompt,
                searchResultLimit: optionsLimit,
                shouldSort: false,
                searchFloor: hasDynamicSearchResults ? 0 : 1,
            })

            await this.refreshChoices({ withInitialOptions: true })

            if (![null, undefined, ''].includes(this.state)) {
                this.select.setChoiceByValue(this.formatState(this.state))
            }

            this.refreshPlaceholder()

            if (isAutofocused) {
                this.select.showDropdown()
            }

            this.$refs.input.addEventListener('change', () => {
                this.refreshPlaceholder()

                if (this.isStateBeingUpdated) {
                    return
                }

                this.isStateBeingUpdated = true
                this.state = this.select.getValue(true) ?? null
                this.$nextTick(() => (this.isStateBeingUpdated = false))
            })

            if (hasDynamicOptions) {
                this.$refs.input.addEventListener('showDropdown', async () => {
                    this.select.clearChoices()
                    await this.select.setChoices([
                        {
                            label: loadingMessage,
                            value: '',
                            disabled: true,
                        },
                    ])

                    await this.refreshChoices()
                })
            }

            if (hasDynamicSearchResults) {
                this.$refs.input.addEventListener('search', async (event) => {
                    let search = event.detail.value?.trim()

                    this.isSearching = true

                    this.select.clearChoices()
                    await this.select.setChoices([
                        {
                            label: [null, undefined, ''].includes(search)
                                ? loadingMessage
                                : searchingMessage,
                            value: '',
                            disabled: true,
                        },
                    ])
                })

                this.$refs.input.addEventListener(
                    'search',
                    Alpine.debounce(async (event) => {
                        await this.refreshChoices({
                            search: event.detail.value?.trim(),
                        })

                        this.isSearching = false
                    }, searchDebounce),
                )
            }

            if (!isMultiple) {
                window.addEventListener(
                    'filament-forms::select.refreshSelectedOptionLabel',
                    async (event) => {
                        if (event.detail.livewireId !== livewireId) {
                            return
                        }

                        if (event.detail.statePath !== statePath) {
                            return
                        }

                        await this.refreshSelectedOption()
                    },
                )
            }

            this.$watch('state', async () => {
                if (!this.select) {
                    return
                }

                this.refreshPlaceholder()

                if (this.isStateBeingUpdated) {
                    return
                }

                await this.refreshSelectedOption()
            })
        },

        destroy: function () {
            this.select.destroy()
            this.select = null
        },

        refreshChoices: async function (config = {}) {
            this.setChoices(await this.getChoices(config))
        },

        refreshSelectedOption: async function () {
            const choices = await this.getChoices({
                withInitialOptions: !hasDynamicOptions,
            })

            this.select.clearStore()

            this.refreshPlaceholder()

            this.setChoices(choices)

            if (![null, undefined, ''].includes(this.state)) {
                this.select.setChoiceByValue(this.formatState(this.state))
            }
        },

        setChoices: function (choices) {
            this.select.setChoices(choices, 'value', 'label', true)
        },

        getChoices: async function (config = {}) {
            const existingOptions = await this.getOptions(config)

            return existingOptions.concat(
                await this.getMissingOptions(existingOptions),
            )
        },

        getOptions: async function ({ search, withInitialOptions }) {
            if (withInitialOptions) {
                return options
            }

            if (search !== '' && search !== null && search !== undefined) {
                return await getSearchResultsUsing(search)
            }

            return await getOptionsUsing()
        },

        refreshPlaceholder: function () {
            if (isDisabled) {
                return
            }

            if (isMultiple) {
                return
            }

            this.select._renderItems()

            if (![null, undefined, ''].includes(this.state)) {
                return
            }

            this.$el.querySelector(
                '.choices__list--single',
            ).innerHTML = `<div class="choices__placeholder choices__item">${placeholder}</div>`
        },

        formatState: function (state) {
            if (isMultiple) {
                return (state ?? []).map((item) => item?.toString())
            }

            return state?.toString()
        },

        getMissingOptions: async function (existingOptions) {
            let state = this.formatState(this.state)

            if ([null, undefined, '', [], {}].includes(state)) {
                return {}
            }

            const existingOptionValues = new Set(
                existingOptions.length
                    ? existingOptions.map((option) => option.value)
                    : [],
            )

            if (isMultiple) {
                if (state.every((value) => existingOptionValues.has(value))) {
                    return {}
                }

                return await getOptionLabelsUsing()
            }

            if (existingOptionValues.has(state)) {
                return existingOptionValues
            }

            return [
                {
                    label: await getOptionLabelUsing(),
                    value: state,
                },
            ]
        },
    }
}
