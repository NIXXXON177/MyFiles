module.exports = {
	prompt: ({ inquirer }) => {
		const questions = [
			{
				type: 'list',
				name: 'base_dir',
				message: 'Где создать компонент?',
				choices: [
					{ name: 'components', value: 'components' },
					{ name: 'UI', value: 'UI' },
				],
				default: 'components',
			},
			{
				type: 'input',
				name: 'component_name',
				message: 'Имя компонента',
			},
			{
				type: 'input',
				name: 'dir',
				message: 'Вложенная директория? (Optional)',
			},
			{
				type: 'confirm',
				name: 'hasStyles',
				message: 'Добавить файл стилей?',
				default: true,
			},
		]
		return inquirer.prompt(questions).then(answers => {
			const { component_name, dir, base_dir, hasStyles } = answers
			const path = `${dir ? `${dir}/` : ''}${component_name}`
			const absPath = `src/${base_dir}/${path}`
			return { ...answers, path, absPath, base_dir, hasStyles }
		})
	},
}
