const { dispatch, select } = wp.data;

/**
 * Register the given block category.
 *
 * @param {string} slug - Category slug.
 * @param {string} title - Category title.
 * @param {Function|string} [icon=null] - Optional. Category icon. Defaults to null.
 */
export function registerBlockCategory(slug, title, icon = null) {
    const { getCategories } = select('core/blocks');
    const { setCategories } = dispatch('core/blocks');

    setCategories([
        ...(getCategories() || []),
        {
            icon,
            slug,
            title,
        },
    ]);
}