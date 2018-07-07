<?php
/**
 * Created by BChar
 * Date: 05/07/2018
 * Time: 00:31
 * src/Form/ProductType.php
 */
namespace App\Form;


use Symfony\Component\Cache\Adapter\AbstractAdapter;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Entity\Media;

class MediaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('attachment', FileType::class, [
                'label' => 'Media (type file)',
            ])
            ->add('save', SubmitType::class, ['label' => 'Create Media'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Media::class,
        ]);
    }
}