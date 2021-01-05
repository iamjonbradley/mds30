require 'rubygems'
require 'active_support'
require 'active_record'
require 'time'

ActiveRecord::Base.pluralize_table_names = false

#
# => DEFINE CONNECTIONS
#

class EtlBase < ActiveRecord::Base
  self.abstract_class = true
  establish_connection(
    :adapter => 'mysql2',
    :host => 'localhost',
    :port => 3306,
    :database => 'mds_mdi',
    :username => 'root',
    :password => ''
  )
end

class MdsBase < ActiveRecord::Base
  self.abstract_class = true
  establish_connection(
    :adapter => 'mysql2',
    :host => 'localhost',
    :port => 3306,
    :database => 'mds',
    :username => 'root',
    :password => ''
  )
end

#
# => DEFINE TABLES
#

# MDI Resident Table
class Admission < EtlBase
  self.table_name = "dbo.tblAdmission"
end
# MDI Assessments Table
class AssessmentControl < EtlBase
  self.table_name = "dbo.AssessmentControl"
end
# MDI Assessment Answers
class AssessmentAnswer < EtlBase
  self.table_name = 'dbo.AssessmentAnswer'
end
# MDI Assessment Question
class Question < EtlBase
  self.table_name = 'dbo.Question'
end
# MDS Residents Table
class Resident < MdsBase
  self.table_name = 'residents'
end
# MDS Assessments Table
class Assessment < MdsBase
  self.table_name = 'assessments'
  has_one :section_a
  has_one :section_b
  has_one :section_c
  has_one :section_d
  has_one :section_e
  has_one :section_f
  has_one :section_g
  has_one :section_h
  has_one :section_i
  has_one :section_j
  has_one :section_k
  has_one :section_l
  has_one :section_m
  has_one :section_n
  has_one :section_o
  has_one :section_p
  has_one :section_q
  has_one :section_r
  has_one :section_s
  has_one :section_v
  has_one :section_x
  has_one :section_z
end
# MDS Section A Table
class SectionA < MdsBase
  self.table_name = 'section_a'
  belongs_to :assessment
  validates :A0500, :presence => true
  validates :A0900, :presence => true
  before_save :format_dates

  def format_dates
    A0900       = Time.parse(self.A0900)
    A1600       = Time.parse(self.A1600)
    A2300       = Time.parse(self.A2300)
    A2400B      = Time.parse(self.A2400B)
    A2400C      = Time.parse(self.A2400C)

    self.A0900  = A0900.strftime("%y-%m-%d")
    self.A1600  = A1600.strftime("%y-%m-%d")
    self.A2300  = A2300.strftime("%y-%m-%d")
    self.A2400B = A2400B.strftime("%y-%m-%d")
    self.A2400C = A2400C.strftime("%y-%m-%d")
  end
end
# MDS Section B Table
class SectionB < MdsBase
  self.table_name = 'section_b'
  belongs_to :assessment
end
# MDS Section C Table
class SectionC < MdsBase
  self.table_name = 'section_c'
  belongs_to :assessment
end
# MDS Section D Table
class SectionD < MdsBase
  self.table_name = 'section_d'
  belongs_to :assessment
end
# MDS Section E Table
class SectionE < MdsBase
  self.table_name = 'section_e'
  belongs_to :assessment
end
# MDS Section F Table
class SectionF < MdsBase
  self.table_name = 'section_f'
  belongs_to :assessment
end
# MDS Section g Table
class SectionG < MdsBase
  self.table_name = 'section_g'
  belongs_to :assessment
end
# MDS Section H Table
class SectionH < MdsBase
  self.table_name = 'section_h'
  belongs_to :assessment
end
# MDS Section I Table
class SectionI < MdsBase
  self.table_name = 'section_i'
  belongs_to :assessment
end
# MDS Section J Table
class SectionJ < MdsBase
  self.table_name = 'section_j'
  belongs_to :assessment
end
# MDS Section K Table
class SectionK < MdsBase
  self.table_name = 'section_k'
  belongs_to :assessment
end
# MDS Section L Table
class SectionL < MdsBase
  self.table_name = 'section_l'
  belongs_to :assessment
end
# MDS Section M Table
class SectionM < MdsBase
  self.table_name = 'section_m'
  belongs_to :assessment
end
# MDS Section N Table
class SectionN < MdsBase
  self.table_name = 'section_n'
  belongs_to :assessment
end
# MDS Section O Table
class SectionO < MdsBase
  self.table_name = 'section_o'
  belongs_to :assessment
end
# MDS Section P Table
class SectionP < MdsBase
  self.table_name = 'section_p'
  belongs_to :assessment
end
# MDS Section Q Table
class SectionQ < MdsBase
  self.table_name = 'section_q'
  belongs_to :assessment
end
# MDS Section S Table
class SectionS < MdsBase
  self.table_name = 'section_s'
  belongs_to :assessment
end
# MDS Section V Table
class SectionV < MdsBase
  self.table_name = 'section_v'
  belongs_to :assessment
end
# MDS Section X Table
class SectionX < MdsBase
  self.table_name = 'section_x'
  belongs_to :assessment
end
# MDS Section Z Table
class SectionZ < MdsBase
  self.table_name = 'section_z'
  belongs_to :assessment
end

#
# => START PROCESSING
#

# loop through all the assessments in the system
#AssessmentControl.all.each do |c|
# for debugging
AssessmentControl.all.each_with_index do |c, idx|
  next unless idx > 1 && idx < 10
  # get the answers for the assessment from MDI
  answers = AssessmentAnswer.where(:AssessmentControlFK => c.attributes['AssessmentControlIDY']).all
  # check if answers is empty
  if answers.present?
    # get the resident record from MDI
    admission = Admission.where(:AdmissionPK => c.attributes['ResidentFK']).first
    # assign all sections to the assessment
    section = Hash.new
    answers.each do |x|
      # get what question each answer relates to
      question = Question.where(:QuestionIDY => x.attributes['QuestionFK']).first
      # set section name
      section_name = question['QuestionName'][0,1].downcase
      # check if empty question
      if question.present? && section_name.present?
        # check if the section exists
        section[section_name] ||= {}
        # add the question to the section
        section[section_name][question['QuestionName']] = x.attributes['Answer']
      end
    end
    # structure the resident id
    @resident_id = "44-#{section['a']['A1300A']}"
    # check for resident from MDS
    resident = Resident.where(:id => @resident_id).first
    # see if the new resident exists
    if resident.nil?
      # create a new resident in MDS
      resident = Resident.new(
        :facility_id => 44,
        :PATNUM => c.attributes['ResidentFK'],
        :PATFNAME => admission['Lastname'],
        :PATLNAME => admission['Firstname'],
        :PMI => admission['MI'],
        :SSNUM => admission['SSN'],
        :READM => '',
        :RESNO => c.attributes['ResidentFK'],
        :ADATE => admission['OriginalAdmissionDate'],
        :MEDICARE => admission['Medicare'],
        :MEDICAID => admission['Medicaid#'],
        :BDATE => admission['Birthday'],
        :modified => Date.today.to_s,
        :created => Date.today.to_s
      )
      resident.id = @resident_id
      resident.save :validate => false
    end
    # start new assesment hash
    asmt = Hash.new
    asmt = {
      :facility_id => 44,
      :resident => @resident_id,
      :locked => c.attributes['LockedForSubmissionFlag'],
      :transmission_status => 2,
      :deleted => 0,
      :created => c.attributes['DateSubmission'],
      :modified => c.attributes['DateSubmission'],
      :asmt_type => 'NC',
      :lock_date => c.attributes['DateSubmission']
    }
    # check if X0100 exists
    if section.has_key?('x') && section.has_key?('a') && section['x'].has_key?('X0100')
      # define A0500 since MDI sucks at life and can't do shit right
      section['a']['A0500'] = section['x']['X0100']
    end
    # start new assessment save
    assessment = Assessment.new(asmt)
    # loop through all sections
    section.each do |key, value|
      # check if valid section
      if key.present? && value.present?
        # mark section validated
        section[key]['validated'] = 1
        # assign variables to a section
        assessment.send("build_section_#{key}", value.slice(*("section_#{key}".camelize.constantize.column_names)))
      end
    end
    # save the assessment as a whole
    p asssessment
    assessment.save!
    # test to make sure the assessment saved
    print '.'
  end
end