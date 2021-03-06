const config = Joomla.getOptions('config') || {};
const prefix = 'stations';

window.addEventListener('DOMContentLoaded', async () => {
	async function init() {
		await getIcons();
		handleIconSearch();
	}

	init();

	/**
	 * Handling the icon search
	 */
	function handleIconSearch() {
		const element = document.querySelector(`input.${prefix}-icon-search`);
		const placeholder = document.querySelector(
			`.${prefix}-icons-searchbar .placeholder-icon`
		);
		const remove = document.querySelector(
			`.${prefix}-icons-searchbar .remove-icon`
		);

		let timeout = null;

		/** Filter the icons */
		element.addEventListener('keyup', async event => {
			event.preventDefault();

			const { value } = event.target;
			timeout && clearTimeout(timeout);

			if (value !== '') {
				remove.style.display = 'inline-block';
				placeholder.style.display = 'none';
			} else {
				remove.style.display = 'none';
				placeholder.style.display = 'inline-block';
			}

			timeout = setTimeout(async () => {
				await getIcons(value);
			}, 300);
		});

		/** Remove the filter */
		remove.addEventListener('click', async e => {
			e.preventDefault();
			element.value = '';
			await getIcons();
		});
	}

	/**
	 * Get the icons using API request.
	 *
	 * @param {string} keyword
	 */
	async function getIcons(keyword = '') {
		const element = document.querySelector(`.${prefix}-icomoon-icons`);
		const totalMessage = document.querySelector(`.${prefix}-total-icons`);
		const keywordElement = document.querySelector(
			`.${prefix}-search-tokens`
		);

		const url = `${config.base}/administrator/index.php?option=com_${prefix}&task=icomoon.getIcons&keyword=${keyword}`;

		const res = await fetch(url, {
			method: 'GET',
			headers: {
				'Content-Type': 'application/json',
			},
		});

		const data = await res.json();

		if (data.success) {
			element.innerHTML = data.data.html;
			totalMessage.innerHTML = `Total ${data.data.total} ${
				data.data.total <= 0 ? 'Icon' : 'Icons'
			}`;

			if (keyword.length > 0) {
				keyword = keyword.replace(/\s+/g, ' ').trim();
				const keywordArray = keyword.split(/\s+/);

				keywordElement.innerHTML = keywordArray
					.map(
						(token, index) =>
							`<div class="${prefix}-search-keyword" data-index="${index}"><span>${token}</span> <span class="icon-cancel-circle" style="margin-left: 8px;"></span></div>`
					)
					.join('\n');

				removeKeyword();
			} else {
				keywordElement.innerHTML = '';
			}

			copy2clipboard();
		}
	}

	/**
	 * Remove search keyword tokens on click
	 */
	function removeKeyword() {
		const items = document.querySelectorAll(`.${prefix}-search-keyword`);
		const element = document.querySelector(`input.${prefix}-icon-search`);
		let keyword = element.value;

		keyword = keyword.replace(/\s+/, ' ').trim();
		const keywordArray = keyword.split(' ');

		for (const item of items) {
			item.addEventListener('click', async e => {
				const index = item.dataset.index;

				keywordArray.splice(index, 1);
				element.value = keywordArray.join(' ');

				await getIcons(element.value);
			});
		}
	}

	/**
	 * Copy icon name to the clipboard with icon- prefix
	 */
	function copy2clipboard() {
		const elements = document.querySelectorAll(
			`.${prefix}-icomoon-icons .box`
		);

		for (const element of elements) {
			element.addEventListener('click', e => {
				e.preventDefault();

				const iconName = element.querySelector('.icon-name');
				const messageEl = element.querySelector(
					`.${prefix}-copied-message`
				);
				const virtualEl = document.createElement('input');
				virtualEl.value = iconName.innerHTML;
				document.body.appendChild(virtualEl);
				virtualEl.select();

				try {
					const response = document.execCommand('copy');

					if (response) {
						messageEl.style.display = 'flex';
						setTimeout(() => {
							messageEl.style.display = 'none';
						}, 1000);
					}
				} catch (e) {
					console.error(e.message);
				}

				document.body.removeChild(virtualEl);
			});
		}
	}
});
